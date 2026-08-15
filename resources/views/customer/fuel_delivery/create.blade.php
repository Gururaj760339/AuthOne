<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto px-4 py-10">

        <div class="mb-6">
            <a href="{{ route('fuel.delivery.my') }}" class="text-red-600 hover:text-red-700">
                ← Back
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-800">
                    Fuel Delivery
                </h1>

                <p class="text-gray-500 mt-2">
                    Request emergency fuel delivery to your current location.
                </p>

            </div>


            {{-- Success --}}
            @if (session('success'))
                <div
                    class="bg-green-100 border border-green-300
                            text-green-700 px-4 py-3 rounded-lg mb-6">

                    {{ session('success') }}

                </div>
            @endif


            {{-- Error --}}
            @if (session('error'))
                <div
                    class="bg-red-100 border border-red-300
                            text-red-700 px-4 py-3 rounded-lg mb-6">

                    {{ session('error') }}

                </div>
            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div
                    class="bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-lg mb-6">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form action="{{ route('fuel.delivery.store') }}" method="POST" class="space-y-6">

                @csrf


                {{-- Fuel Type --}}
                <div>

                    <label for="fuel_type" class="block text-sm font-semibold text-gray-700 mb-2">
                        Fuel Type
                    </label>

                    <select id="fuel_type" name="fuel_type"
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:ring-2 focus:ring-red-500
                               focus:border-red-500 outline-none"
                        required>

                        <option value="">
                            Select Fuel Type
                        </option>

                        <option value="petrol_91" {{ old('fuel_type') == 'petrol_91' ? 'selected' : '' }}>
                            Petrol 91
                        </option>

                        <option value="petrol_95" {{ old('fuel_type') == 'petrol_95' ? 'selected' : '' }}>
                            Petrol 95
                        </option>

                        <option value="petrol_98" {{ old('fuel_type') == 'petrol_98' ? 'selected' : '' }}>
                            Petrol 98
                        </option>

                        <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>
                            Diesel
                        </option>

                    </select>

                </div>


                {{-- Quantity --}}
                <div>

                    <label for="requested_quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                        Required Quantity (Litres)
                    </label>

                    <input type="number" id="requested_quantity" name="requested_quantity"
                        value="{{ old('requested_quantity') }}" min="1" max="500" step="0.1"
                        placeholder="Example: 20"
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:ring-2 focus:ring-red-500
                               outline-none"
                        required>

                </div>


                {{-- Address --}}
                <div>

                    <label for="delivery_address" class="block text-sm font-semibold text-gray-700 mb-2">
                        Delivery Address
                    </label>

                    <textarea id="delivery_address" name="delivery_address" rows="4" placeholder="Enter your current location"
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:ring-2 focus:ring-red-500
                               outline-none"
                        required>{{ old('delivery_address') }}</textarea>

                </div>


                {{-- Location --}}
                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-2">
                            Latitude
                        </label>

                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-3
                                   bg-gray-50"
                            readonly>

                    </div>


                    <div>

                        <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-2">
                            Longitude
                        </label>

                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-3
                                   bg-gray-50"
                            readonly>

                    </div>

                </div>


                {{-- Location button --}}
                <button type="button" onclick="getLocation()"
                    class="w-full border border-red-600
                           text-red-600 hover:bg-red-50
                           py-3 rounded-lg font-semibold">
                    📍 Detect My Location
                </button>


                <div id="locationMessage" class="text-sm text-gray-500">
                </div>


                {{-- Delivery Fee --}}
                <div>

                    <label for="delivery_fee" class="block text-sm font-semibold text-gray-700 mb-2">
                        Delivery Fee
                    </label>

                    <input type="number" id="delivery_fee" name="delivery_fee" value="{{ old('delivery_fee', 20) }}"
                        min="0" step="0.01"
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:ring-2 focus:ring-red-500
                               outline-none"
                        required>

                </div>


                {{-- Emergency Fee --}}
                <div>

                    <label for="emergency_fee" class="block text-sm font-semibold text-gray-700 mb-2">
                        Emergency Fee
                    </label>

                    <input type="number" id="emergency_fee" name="emergency_fee" value="{{ old('emergency_fee', 0) }}"
                        min="0" step="0.01"
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:ring-2 focus:ring-red-500
                               outline-none">

                </div>


                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-red-600
                           hover:bg-red-700
                           text-white font-bold
                           py-4 rounded-lg
                           transition">
                    Request Fuel Delivery
                </button>

            </form>

        </div>

    </div>


    <script>
        function getLocation() {

            const message =
                document.getElementById('locationMessage');

            if (!navigator.geolocation) {

                message.innerText =
                    'Geolocation is not supported by your browser.';

                return;
            }

            message.innerText =
                'Detecting your location...';

            navigator.geolocation.getCurrentPosition(

                function(position) {

                    document.getElementById('latitude').value =
                        position.coords.latitude;

                    document.getElementById('longitude').value =
                        position.coords.longitude;

                    message.innerText =
                        '✓ Location detected successfully.';

                },

                function(error) {

                    message.innerText =
                        'Unable to detect location. Please enter your address manually.';

                }
            );
        }
    </script>

</body>

</html>
