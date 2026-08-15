<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Request Roadside Assistance - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-slate-950 text-white">

        <div class="max-w-7xl mx-auto px-4">

            <div class="h-16 flex items-center justify-between">

                <a href="{{ url('/') }}" class="text-xl font-bold">
                    AutoOne
                </a>

                <a href="#" class="text-sm hover:text-red-400">
                    My Requests
                </a>

            </div>

        </div>

    </nav>


    <main class="max-w-3xl mx-auto px-4 py-10">

        {{-- Page Header --}}
        <div class="mb-8">

            <p class="text-red-600 text-sm font-semibold">
                ROADSIDE ASSISTANCE
            </p>

            <h1 class="text-3xl font-bold text-slate-900 mt-2">
                Request Assistance
            </h1>

            <p class="text-slate-500 mt-2">
                Tell us what roadside assistance you need.
            </p>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 rounded-xl p-5">

                <p class="font-semibold mb-2">
                    Please fix the following errors:
                </p>

                <ul class="list-disc ml-5 text-sm">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200
                        text-green-700 rounded-xl p-5">

                {{ session('success') }}

            </div>
        @endif


        {{-- Selected Provider --}}
        <div class="bg-white border rounded-2xl p-6 mb-6">

            <div class="flex items-start justify-between gap-5">

                <div>

                    <p class="text-xs text-slate-400 uppercase tracking-wide">
                        Selected Roadside Partner
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 mt-1">
                        {{ $provider->name ?? 'Roadside Partner' }}
                    </h2>

                    @if (isset($provider->distance))
                        <p class="text-sm text-slate-500 mt-1">
                            📍
                            {{ number_format($provider->distance, 2) }}
                            km away
                        </p>
                    @endif

                </div>

                <div
                    class="px-3 py-1 bg-green-100 text-green-700
                            rounded-full text-xs font-semibold">

                    Available

                </div>

            </div>

        </div>


        {{-- Request Form --}}
        <form action="{{ route('customer.roadside.request.store') }}" method="POST"
            class="bg-white border rounded-2xl p-6 md:p-8">

            @csrf


            {{-- Provider ID --}}
            <input type="hidden" name="provider_id" value="{{ $provider->id }}">


            {{-- Latitude --}}
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $latitude ?? '') }}">


            {{-- Longitude --}}
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $longitude ?? '') }}">


            {{-- ============================= --}}
            {{-- ASSISTANCE TYPE --}}
            {{-- ============================= --}}

            <div class="mb-6">

                <label for="assistance_type"
                    class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    What Assistance Do You Need?

                    <span class="text-red-500">*</span>

                </label>

                <select id="assistance_type" name="assistance_type" required
                    class="w-full border rounded-xl px-4 py-3
                               outline-none bg-white
                               focus:ring-2 focus:ring-red-500">

                    <option value="">
                        Select Assistance Type
                    </option>

                    <option value="flat_tire" {{ old('assistance_type') == 'flat_tire' ? 'selected' : '' }}>
                        🚗 Flat Tire
                    </option>

                    <option value="battery" {{ old('assistance_type') == 'battery' ? 'selected' : '' }}>
                        🔋 Battery / Jump Start
                    </option>

                    <option value="fuel_delivery" {{ old('assistance_type') == 'fuel_delivery' ? 'selected' : '' }}>
                        ⛽ Fuel Delivery
                    </option>

                    <option value="engine_problem" {{ old('assistance_type') == 'engine_problem' ? 'selected' : '' }}>
                        🔧 Engine Problem
                    </option>

                    <option value="lockout" {{ old('assistance_type') == 'lockout' ? 'selected' : '' }}>
                        🔑 Car Lockout
                    </option>

                    <option value="accident" {{ old('assistance_type') == 'accident' ? 'selected' : '' }}>
                        🚨 Accident Assistance
                    </option>

                    <option value="towing" {{ old('assistance_type') == 'towing' ? 'selected' : '' }}>
                        🚛 Towing
                    </option>

                    <option value="other" {{ old('assistance_type') == 'other' ? 'selected' : '' }}>
                        🛠️ Other
                    </option>

                </select>

            </div>


            {{-- ============================= --}}
            {{-- PRIORITY --}}
            {{-- ============================= --}}

            <div class="mb-6">

                <label for="priority"
                    class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Priority

                    <span class="text-red-500">*</span>

                </label>

                <select id="priority" name="priority" required
                    class="w-full border rounded-xl px-4 py-3
                               outline-none bg-white
                               focus:ring-2 focus:ring-red-500">

                    <option value="">
                        Select Priority
                    </option>

                    <option value="normal" {{ old('priority', 'normal') == 'normal' ? 'selected' : '' }}>
                        🟢 Normal
                    </option>

                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>
                        🟠 Urgent
                    </option>

                    <option value="emergency" {{ old('priority') == 'emergency' ? 'selected' : '' }}>
                        🔴 Emergency
                    </option>

                </select>

            </div>


            {{-- ============================= --}}
            {{-- VEHICLE ID --}}
            {{-- ============================= --}}

            <div class="mb-6">

                <label for="vehicle_id"
                    class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Select Vehicle

                </label>

                <select id="vehicle_id" name="vehicle_id"
                    class="w-full border rounded-xl px-4 py-3
                               outline-none bg-white
                               focus:ring-2 focus:ring-red-500">

                    <option value="">
                        Select Your Vehicle
                    </option>

                    @if (isset($vehicles))

                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>

                                @if (!empty($vehicle->carBrand->name))
                                    {{ $vehicle->carBrand->name }}
                                @endif

                                @if (!empty($vehicle->title))
                                    {{ $vehicle->title }}
                                @endif

                            </option>
                        @endforeach

                    @endif

                </select>

                <p class="text-xs text-slate-400 mt-2">
                    Select the vehicle that needs assistance.
                </p>

            </div>


            {{-- ============================= --}}
            {{-- DESCRIPTION --}}
            {{-- ============================= --}}

            <div class="mb-6">

                <label for="description"
                    class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Describe Your Problem

                </label>

                <textarea id="description" name="description" rows="5"
                    placeholder="Example: My car battery is dead and the vehicle won't start."
                    class="w-full border rounded-xl px-4 py-3
                                 outline-none
                                 focus:ring-2 focus:ring-red-500">{{ old('description') }}</textarea>

            </div>


            {{-- ============================= --}}
            {{-- PHONE --}}
            {{-- ============================= --}}

            <div class="mb-6">

                <label for="phone"
                    class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Contact Phone

                </label>

                <input type="text" id="phone" name="phone"
                    value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="+8801XXXXXXXXX"
                    class="w-full border rounded-xl px-4 py-3
                              outline-none
                              focus:ring-2 focus:ring-red-500">

                <p class="text-xs text-slate-400 mt-2">
                    Your registered phone number will be used for contact.
                </p>

            </div>


            {{-- ============================= --}}
            {{-- ADDRESS --}}
            {{-- ============================= --}}

            <div class="mb-6">

                <label for="address"
                    class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Current Location / Address

                    <span class="text-red-500">*</span>

                </label>

                <textarea id="address" name="address" rows="3" required
                    placeholder="Enter your current location or address..."
                    class="w-full border rounded-xl px-4 py-3
                                 outline-none
                                 focus:ring-2 focus:ring-red-500">{{ old('address') }}</textarea>

            </div>


            {{-- ============================= --}}
            {{-- GPS COORDINATES --}}
            {{-- ============================= --}}

            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-4 mb-6">

                <div>

                    <label for="showLatitude"
                        class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Latitude

                    </label>

                    <input type="text" id="showLatitude" value="{{ old('latitude', $latitude ?? '') }}" readonly
                        class="w-full border rounded-xl px-4 py-3
                                  bg-slate-50 text-slate-600">

                </div>


                <div>

                    <label for="showLongitude"
                        class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Longitude

                    </label>

                    <input type="text" id="showLongitude" value="{{ old('longitude', $longitude ?? '') }}"
                        readonly
                        class="w-full border rounded-xl px-4 py-3
                                  bg-slate-50 text-slate-600">

                </div>

            </div>


            {{-- Update Location --}}
            <button type="button" onclick="getCurrentLocation()"
                class="w-full mb-6
                           border border-red-600
                           text-red-600
                           hover:bg-red-50
                           rounded-xl
                           py-3
                           font-semibold">

                📍 Update My Location

            </button>


            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-red-600
                           hover:bg-red-700
                           text-white
                           rounded-xl
                           py-4
                           font-bold
                           transition">

                🚨 Submit Roadside Assistance Request

            </button>


            <p class="text-xs text-slate-400
                      text-center mt-4">

                Your location will be shared with
                the selected roadside assistance partner.

            </p>

        </form>

    </main>


    {{-- GPS Script --}}
    <script>
        function getCurrentLocation() {

            if (!navigator.geolocation) {

                alert(
                    'Geolocation is not supported by your browser.'
                );

                return;
            }


            navigator.geolocation.getCurrentPosition(

                function(position) {

                    const latitude =
                        position.coords.latitude;

                    const longitude =
                        position.coords.longitude;


                    document.getElementById(
                        'latitude'
                    ).value = latitude;


                    document.getElementById(
                        'longitude'
                    ).value = longitude;


                    document.getElementById(
                        'showLatitude'
                    ).value = latitude;


                    document.getElementById(
                        'showLongitude'
                    ).value = longitude;


                    alert(
                        'Your location has been updated successfully.'
                    );

                },


                function(error) {

                    let message =
                        'Unable to get your location.';


                    if (error.code === 1) {

                        message =
                            'Location permission was denied.';

                    } else if (error.code === 2) {

                        message =
                            'Your location is currently unavailable.';

                    } else if (error.code === 3) {

                        message =
                            'Location request timed out.';

                    }


                    alert(message);

                },


                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }

            );

        }
    </script>

</body>

</html>
