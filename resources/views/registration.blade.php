<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Create Account') }} | AutoOne</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left Side: Image and Stats -->
        <div class="hidden lg:flex lg:w-1/2 relative p-12 items-center">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-slate-900/75"></div>

            <div class="relative z-10 text-white">

                <span class="bg-red-600 px-4 py-2 rounded-full text-sm font-semibold">
                    {{ translate('Join AutoOne') }}
                </span>
                <h1 class="text-5xl font-bold mt-6 leading-tight">
                    {{ translate('Create AutoOne Account') }}
                </h1>
                <p class="mt-6 text-lg text-gray-300 leading-8">
                    {{ translate('Register Description') }}
                </p>

                <div class="grid grid-cols-2 gap-8 mt-12">
                    <div>
                        <h2 class="text-3xl font-bold">25K+</h2>
                        <p class="text-gray-300 mt-2">{{ translate('Happy Customers') }}</p>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">500+</h2>
                        <p class="text-gray-300 mt-2">{{ translate('Vehicles Available') }}</p>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">150+</h2>
                        <p class="text-gray-300 mt-2">{{ translate('Workshop Partners') }}</p>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">12</h2>
                        <p class="text-gray-300 mt-2">{{ translate('Countries Served') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 lg:p-16">
            <div class="w-full max-w-md">
                @include('ai_layer.ai_language_translate')
                <h2 class="text-3xl font-bold">{{ translate('Create Account') }}</h2>
                <p class="text-gray-500 mt-2 mb-8">{{ translate('Join Under Minute') }}</p>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Register.blade.php -->
                <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-5">

                        {{-- ================================================= --}}
                        {{-- BASIC CUSTOMER INFORMATION --}}
                        {{-- ================================================= --}}

                        {{-- Full Name --}}
                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Full Name') }}
                            </label>

                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Email Address') }}
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Phone Number') }}
                            </label>

                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>

                        {{-- Profile Picture --}}
                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Profile Picture') }}
                            </label>

                            <input type="file" name="profile_picture" class="w-full border rounded-lg px-4 py-2 mt-1"
                                accept="image/*">
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Password') }}
                            </label>

                            <input type="password" name="password"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Confirm Password') }}
                            </label>

                            <input type="password" name="password_confirmation"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Country
                            </label>

                            <select name="country_id" class="w-full border rounded-lg px-4 py-3" required>

                                <option value="">Select Country</option>

                                @foreach (\App\Models\Country::where('is_active', true)->orderBy('region')->orderBy('name')->get() as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>

                                        {{ $country->name }}
                                        ({{ $country->currency_code }})
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        {{-- ================================================= --}}
                        {{-- ACCOUNT TYPE --}}
                        {{-- ================================================= --}}

                        <div>
                            <label class="block font-medium text-gray-700">
                                {{ translate('Account Type') }}
                            </label>

                            <select id="role" name="role"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>

                                {{-- Customer --}}
                                <option value="customer" {{ old('role', 'customer') == 'customer' ? 'selected' : '' }}>
                                    {{ translate('Customer') }}
                                </option>

                                {{-- Vendor Partner --}}
                                <option value="vendor" {{ old('role') == 'vendor' ? 'selected' : '' }}>
                                    {{ translate('Become a Vendor Partner') }}
                                </option>

                                {{-- Roadside Partner --}}
                                <option value="roadside_provider"
                                    {{ old('role') == 'roadside_provider' ? 'selected' : '' }}>
                                    {{ translate('Become a Roadside Assistance Partner') }}
                                </option>

                                {{-- Fuel Partner --}}
                                <option value="fuel_partner" {{ old('role') == 'fuel_partner' ? 'selected' : '' }}>
                                    {{ translate('Become a Fuel Partner') }}
                                </option>

                            </select>
                        </div>

                        {{-- ================================================= --}}
                        {{-- VENDOR PARTNER --}}
                        {{-- ================================================= --}}

                        <div id="vendorFields"
                            class="hidden space-y-5 mt-5 p-5 border border-blue-200 rounded-xl bg-blue-50">
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ translate('Vendor Partner Information') }}
                            </h3>

                            {{-- Vendor Type --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Type') }}
                                </label>

                                <select name="vendor_type" id="vendor_type"
                                    class="w-full border rounded-lg px-4 py-3 mt-1">
                                    <option value="">
                                        {{ translate('Select Business Type') }}
                                    </option>

                                    <option value="service" {{ old('vendor_type') == 'service' ? 'selected' : '' }}>
                                        {{ translate('Workshop & Car Wash') }}
                                    </option>

                                    <option value="dealer" {{ old('vendor_type') == 'dealer' ? 'selected' : '' }}>
                                        {{ translate('Car Dealer') }}
                                    </option>

                                    <option value="rental" {{ old('vendor_type') == 'rental' ? 'selected' : '' }}>
                                        {{ translate('Car Rental') }}
                                    </option>

                                    <option value="car_importer"
                                        {{ old('vendor_type') == 'car_importer' ? 'selected' : '' }}>
                                        {{ translate('Car Importer') }}
                                    </option>
                                </select>
                            </div>

                            {{-- Business Name --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Name') }}
                                </label>

                                <input type="text" name="business_name" value="{{ old('business_name') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter business name') }}">
                            </div>

                            {{-- Trade License --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Trade License') }}
                                </label>

                                <input type="text" name="trade_license" value="{{ old('trade_license') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1">
                            </div>

                            {{-- Address --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Address') }}
                                </label>

                                <textarea name="address" rows="3" class="w-full border rounded-lg px-4 py-3 mt-1">{{ old('address') }}</textarea>
                            </div>

                            {{-- City + Country --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- City --}}
                                <div>
                                    <label class="block font-medium text-gray-700">
                                        {{ translate('City') }}
                                    </label>

                                    <input type="text" name="city" value="{{ old('city') }}"
                                        class="w-full border rounded-lg px-4 py-3 mt-1">
                                </div>

                                {{-- Country --}}
                                <div>
                                    <label class="block font-medium text-gray-700">
                                        {{ translate('Country') }}
                                    </label>

                                    <input type="text" name="country" value="{{ old('country', 'Bangladesh') }}"
                                        class="w-full border rounded-lg px-4 py-3 mt-1">
                                </div>

                            </div>

                            {{-- Business Logo --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Logo') }}
                                </label>

                                <input type="file" name="logo" class="w-full border rounded-lg px-4 py-2 mt-1"
                                    accept="image/*">
                            </div>
                        </div>

                        {{-- ================================================= --}}
                        {{-- ROADSIDE ASSISTANCE PARTNER --}}
                        {{-- ================================================= --}}

                        <div id="roadsideFields"
                            class="hidden space-y-5 mt-5 p-5 border border-red-200 rounded-xl bg-red-50">
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ translate('Roadside Assistance Partner Information') }}
                            </h3>

                            <p class="text-sm text-gray-600">
                                {{ translate('Register your roadside assistance business and become an AutoOne partner.') }}
                            </p>

                            {{-- Company Name --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Company Name') }}
                                </label>

                                <input type="text" name="company_name" value="{{ old('company_name') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter company name') }}">
                            </div>

                            {{-- Provider Type --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Roadside Service Type') }}
                                </label>

                                <select name="provider_type" id="provider_type"
                                    class="w-full border rounded-lg px-4 py-3 mt-1">
                                    <option value="">
                                        {{ translate('Select Service Type') }}
                                    </option>

                                    <option value="tow_truck"
                                        {{ old('provider_type') == 'tow_truck' ? 'selected' : '' }}>
                                        {{ translate('Tow Truck') }}
                                    </option>

                                    <option value="mechanic"
                                        {{ old('provider_type') == 'mechanic' ? 'selected' : '' }}>
                                        {{ translate('Mechanic') }}
                                    </option>

                                    <option value="mobile_mechanic"
                                        {{ old('provider_type') == 'mobile_mechanic' ? 'selected' : '' }}>
                                        {{ translate('Mobile Mechanic') }}
                                    </option>

                                    <option value="battery_service"
                                        {{ old('provider_type') == 'battery_service' ? 'selected' : '' }}>
                                        {{ translate('Battery Service') }}
                                    </option>

                                    <option value="fuel_delivery"
                                        {{ old('provider_type') == 'fuel_delivery' ? 'selected' : '' }}>
                                        {{ translate('Fuel Delivery') }}
                                    </option>

                                    <option value="roadside_company"
                                        {{ old('provider_type') == 'roadside_company' ? 'selected' : '' }}>
                                        {{ translate('Roadside Assistance Company') }}
                                    </option>
                                </select>
                            </div>

                            {{-- Provider Phone --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business / Service Phone') }}
                                </label>

                                <input type="tel" name="provider_phone" value="{{ old('provider_phone') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter service phone number') }}">
                            </div>

                            {{-- Location --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- Latitude --}}
                                <div>
                                    <label class="block font-medium text-gray-700">
                                        {{ translate('Latitude') }}
                                    </label>

                                    <input type="number" step="any" name="latitude" id="latitude"
                                        value="{{ old('latitude') }}" class="w-full border rounded-lg px-4 py-3 mt-1"
                                        placeholder="23.8103">
                                </div>

                                {{-- Longitude --}}
                                <div>
                                    <label class="block font-medium text-gray-700">
                                        {{ translate('Longitude') }}
                                    </label>

                                    <input type="number" step="any" name="longitude" id="longitude"
                                        value="{{ old('longitude') }}"
                                        class="w-full border rounded-lg px-4 py-3 mt-1" placeholder="90.4125">
                                </div>

                            </div>

                            {{-- Location Button --}}
                            <div>
                                <button type="button" id="getLocation"
                                    class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg">
                                    {{ translate('Use My Current Location') }}
                                </button>

                                <p id="locationMessage" class="text-sm text-gray-500 mt-2"></p>
                            </div>
                        </div>


                        {{-- ================================================= --}}
                        {{-- FUEL PARTNER --}}
                        {{-- ================================================= --}}

                        <div id="fuelFields"
                            class="hidden space-y-5 mt-5 p-5 border border-green-200 rounded-xl bg-green-50">

                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ translate('Fuel Partner Information') }}
                            </h3>

                            <p class="text-sm text-gray-600">
                                {{ translate('Register your fuel delivery business and become an AutoOne fuel partner.') }}
                            </p>


                            {{-- Company Name --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Company Name') }}
                                </label>

                                <input type="text" name="fuel_company_name"
                                    value="{{ old('fuel_company_name') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter fuel company name') }}">
                            </div>


                            {{-- License Number --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('License Number') }}
                                </label>

                                <input type="text" name="license_number" value="{{ old('license_number') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter fuel license number') }}">
                            </div>


                            {{-- License Expiry --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('License Expiry Date') }}
                                </label>

                                <input type="date" name="license_expiry" value="{{ old('license_expiry') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1">
                            </div>


                            {{-- Business Phone --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Phone') }}
                                </label>

                                <input type="tel" name="fuel_phone" value="{{ old('fuel_phone') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter business phone') }}">
                            </div>


                            {{-- Business Email --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Email') }}
                                </label>

                                <input type="email" name="fuel_email" value="{{ old('fuel_email') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter business email') }}">
                            </div>


                            {{-- Address --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('Business Address') }}
                                </label>

                                <textarea name="fuel_address" rows="3" class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter business address') }}">{{ old('fuel_address') }}</textarea>
                            </div>


                            {{-- City --}}
                            <div>
                                <label class="block font-medium text-gray-700">
                                    {{ translate('City') }}
                                </label>

                                <input type="text" name="fuel_city" value="{{ old('fuel_city') }}"
                                    class="w-full border rounded-lg px-4 py-3 mt-1"
                                    placeholder="{{ translate('Enter city') }}">
                            </div>


                            {{-- Location --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- Latitude --}}
                                <div>
                                    <label class="block font-medium text-gray-700">
                                        {{ translate('Latitude') }}
                                    </label>

                                    <input type="number" step="any" name="fuel_latitude" id="fuel_latitude"
                                        value="{{ old('fuel_latitude') }}"
                                        class="w-full border rounded-lg px-4 py-3 mt-1" placeholder="23.8103">
                                </div>


                                {{-- Longitude --}}
                                <div>
                                    <label class="block font-medium text-gray-700">
                                        {{ translate('Longitude') }}
                                    </label>

                                    <input type="number" step="any" name="fuel_longitude" id="fuel_longitude"
                                        value="{{ old('fuel_longitude') }}"
                                        class="w-full border rounded-lg px-4 py-3 mt-1" placeholder="90.4125">
                                </div>

                            </div>


                            {{-- Location Button --}}
                            <div>

                                <button type="button" id="getFuelLocation"
                                    class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg">

                                    {{ translate('Use My Current Location') }}

                                </button>

                                <p id="fuelLocationMessage" class="text-sm text-gray-500 mt-2">
                                </p>

                            </div>

                        </div>

                        {{-- ================================================= --}}
                        {{-- SUBMIT --}}
                        {{-- ================================================= --}}

                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                            {{ translate('Create Account') }}
                        </button>

                    </div>
                </form>


                <div class="mt-6">

                    <div class="flex items-center gap-3">
                        <hr class="flex-1">
                        <span class="text-gray-400">
                            OR
                        </span>
                        <hr class="flex-1">
                    </div>


                    <a href="{{ route('google.login') }}"
                        class="mt-4 block text-center bg-white text-gray-700 border border-gray-300 py-3 rounded-lg hover:bg-gray-100 transition">
                        {{ translate('Continue with Google') }}
                    </a>


                    {{-- <a href="{{ route('apple.login') }}"
                        class="mt-3 block text-center bg-gray-900 text-white py-3 rounded-lg hover:bg-black transition">
                        Continue with Apple
                    </a> --}}

                </div>

                <!-- Footer Login -->
                <p class="text-center mt-8 text-gray-600">
                    {{ translate('Already have an account?') }}
                    <a href="/login"
                        class="text-red-600 font-semibold hover:underline ml-1">{{ translate('Login') }}</a>
                </p>
                <div class="text-center mt-4">
                    <a href="/"
                        class="text-gray-500 hover:text-red-600 text-sm">{{ translate('Back to Home') }}</a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // =========================================================
        // ROLE FIELDS
        // =========================================================

        const role = document.getElementById('role');

        const vendorFields = document.getElementById('vendorFields');
        const roadsideFields = document.getElementById('roadsideFields');
        const fuelFields = document.getElementById('fuelFields');


        function toggleRoleFields() {

            // Hide all partner fields first
            if (vendorFields) {
                vendorFields.classList.add('hidden');
            }

            if (roadsideFields) {
                roadsideFields.classList.add('hidden');
            }

            if (fuelFields) {
                fuelFields.classList.add('hidden');
            }


            // Vendor
            if (role.value === 'vendor') {

                if (vendorFields) {
                    vendorFields.classList.remove('hidden');
                }
            }


            // Roadside Assistance Partner
            if (role.value === 'roadside_provider') {

                if (roadsideFields) {
                    roadsideFields.classList.remove('hidden');
                }
            }


            // Fuel Partner
            if (role.value === 'fuel_partner') {

                if (fuelFields) {
                    fuelFields.classList.remove('hidden');
                }
            }
        }


        // Role change
        if (role) {
            role.addEventListener('change', toggleRoleFields);

            // Run on page load
            toggleRoleFields();
        }


        // =========================================================
        // ROADSIDE PARTNER LOCATION
        // =========================================================

        const getLocation = document.getElementById('getLocation');

        if (getLocation) {

            getLocation.addEventListener('click', function() {

                const message =
                    document.getElementById('locationMessage');


                if (!navigator.geolocation) {

                    message.innerText =
                        '{{ translate('Geolocation is not supported by your browser.') }}';

                    return;
                }


                message.innerText =
                    '{{ translate('Getting your location...') }}';


                navigator.geolocation.getCurrentPosition(

                    function(position) {

                        document.getElementById('latitude').value =
                            position.coords.latitude.toFixed(7);

                        document.getElementById('longitude').value =
                            position.coords.longitude.toFixed(7);


                        message.innerText =
                            '{{ translate('Location detected successfully.') }}';
                    },


                    function() {

                        message.innerText =
                            '{{ translate('Unable to get your location. Please enter manually.') }}';
                    },


                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );

            });
        }


        // =========================================================
        // FUEL PARTNER LOCATION
        // =========================================================

        const getFuelLocation =
            document.getElementById('getFuelLocation');


        if (getFuelLocation) {

            getFuelLocation.addEventListener('click', function() {

                const message =
                    document.getElementById('fuelLocationMessage');


                if (!navigator.geolocation) {

                    message.innerText =
                        '{{ translate('Geolocation is not supported by your browser.') }}';

                    return;
                }


                message.innerText =
                    '{{ translate('Getting your location...') }}';


                navigator.geolocation.getCurrentPosition(

                    function(position) {

                        document.getElementById('fuel_latitude').value =
                            position.coords.latitude.toFixed(7);

                        document.getElementById('fuel_longitude').value =
                            position.coords.longitude.toFixed(7);


                        message.innerText =
                            '{{ translate('Location detected successfully.') }}';
                    },


                    function() {

                        message.innerText =
                            '{{ translate('Unable to get your location. Please enter manually.') }}';
                    },


                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );

            });
        }

    });
</script>
