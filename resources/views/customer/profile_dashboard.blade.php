<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Customer Profile') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    @include('navbar', ['setting' => $setting])

    <div class="max-w-6xl mx-auto py-10 px-4">

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Left Sidebar -->
            <div class="bg-white rounded-xl shadow-lg p-6">

                <div class="text-center">

                    <div
                        class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-4xl font-bold mx-auto">

                        {{ strtoupper(substr(translate($user->name), 0, 1)) }}

                    </div>

                    <h2 class="mt-4 text-2xl font-bold">
                        {{ translate($user->name) }}
                    </h2>

                    <p class="text-gray-500">
                        {{ translate($user->email) }}
                    </p>

                </div>

                <hr class="my-6">

                <div class="space-y-3">

                    <a href="{{ route('customer.profile') }}" class="block bg-blue-50 hover:bg-blue-100 p-3 rounded-lg">
                        👤 {{ translate('My Profile') }}
                    </a>

                    <a href="{{ route('customer.show.kyc') }}"
                        class="block bg-green-50 hover:bg-green-100 p-3 rounded-lg">
                        🆔 {{ translate('KYC Verification') }}   
                    </a>

                    <a href="#" class="block bg-yellow-50 hover:bg-yellow-100 p-3 rounded-lg">
                        🚗 {{ translate('My Bookings') }}
                    </a>

                    <a href="#" class="block bg-purple-50 hover:bg-purple-100 p-3 rounded-lg">
                        💳 {{ translate('Finance Requests') }}
                    </a>

                    <a href="{{ route('customer.import.requests') }}" class="block bg-pink-50 hover:bg-pink-100 p-3 rounded-lg">
                        🌍 {{ translate('Import Requests') }}
                    </a>

                    <a href="{{ route('customer.warranties') }}" class="block bg-gray-50 hover:bg-gray-100 p-3 rounded-lg">
                        🔑 {{ translate('Warranties') }}
                    </a>

                    <a href="{{ route('p2p.cars.show') }}" class="block bg-yellow-50 hover:bg-yellow-100 p-3 rounded-lg">
                        🚗 {{ translate('Rent My Car') }}
                    </a>

                    <a href="{{ route('p2p.cars.rental.requests') }}" class="block bg-blue-50 hover:bg-blue-100 p-3 rounded-lg">
                        📝 {{ translate('Rental Requests') }}
                    </a>

                </div>

                

            </div>

            <!-- Right Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Profile Card -->
                <div id="profile" class="bg-white rounded-xl shadow-lg p-6">

                    <h2 class="text-2xl font-bold mb-6">
                        {{ translate('Personal Information') }}
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="font-semibold text-gray-600">
                                {{ translate('Name') }}
                            </label>

                            <p class="mt-1">
                                {{ translate($user->name) }}
                            </p>
                        </div>

                        <div>
                            <label class="font-semibold text-gray-600">
                                {{ translate('Email') }}
                            </label>

                            <p class="mt-1">
                                {{ translate($user->email) }}
                            </p>
                        </div>

                        <div>
                            <label class="font-semibold text-gray-600">
                                {{ translate('Phone') }}
                            </label>

                            <p class="mt-1">
                                {{ translate($user->phone ?? 'N/A') }}
                            </p>
                        </div>

                        <div>
                            <label class="font-semibold text-gray-600">
                                {{ translate('Member Since') }}
                            </label>

                            <p class="mt-1">
                                {{ $user->created_at->format('d M Y') }}
                            </p>
                        </div>

                    </div>

                </div>

                <!-- KYC Card -->
                <div class="bg-white rounded-xl shadow-lg p-6">

                    <div class="flex justify-between items-center">

                        <div>

                            <h2 class="text-2xl font-bold">
                                🆔 {{ translate('KYC Verification') }}
                            </h2>

                            <p class="text-gray-500 mt-2">
                                {{ translate('Complete KYC to rent cars, apply for finance and import vehicles.') }}
                            </p>

                        </div>

                        @if(!$kyc)
                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">
                                {{ translate('Please Verify Your KYC') }}
                            </span>
                        
                        @elseif($kyc->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-5 py-2 rounded-lg font-semibold">

                                {{ translate('Pending Review') }}

                            </span>
                        @elseif($kyc->status == 'verified')
                            <span class="bg-green-100 text-green-700 px-5 py-2 rounded-lg font-semibold">

                                {{ translate('Verified') }}

                            </span>
                        @elseif($kyc->status == 'rejected')
                            <span class="bg-red-100 text-red-700 px-5 py-2 rounded-lg font-semibold">

                                {{ translate('Rejected') }}

                            </span>
                        
                        @endif



                    </div>

                    <a href="{{ route('customer.create.kyc') }}"
                        class="inline-block mt-6 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                        {{ translate('Verify Now') }}
                    </a>

                </div>

                <!-- Quick Stats -->
                <div class="grid md:grid-cols-3 gap-5">

                    <div class="bg-white shadow-lg rounded-xl p-6 text-center">

                        <h3 class="text-4xl font-bold text-blue-600">
                            {{ $bookingCount ?? 0 }}
                        </h3>

                        <p class="mt-2">
                            {{ translate('Car Bookings') }}
                        </p>

                    </div>

                    <div class="bg-white shadow-lg rounded-xl p-6 text-center">

                        <h3 class="text-4xl font-bold text-green-600">
                            {{ $financeCount ?? 0 }}
                        </h3>

                        <p class="mt-2">
                            {{ translate('Finance Requests') }}
                        </p>

                    </div>

                    <div class="bg-white shadow-lg rounded-xl p-6 text-center">

                        <h3 class="text-4xl font-bold text-purple-600">
                            {{ $importCount ?? 0 }}
                        </h3>

                        <p class="mt-2">
                            {{ translate('Import Requests') }}
                        </p>

                    </div>

                </div>

                <a href="/" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                    ← {{ translate('Back Home') }}
                </a>

            </div>

        </div>

    </div>

</body>

</html>
