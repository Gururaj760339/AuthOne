<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | AutoOne</title>
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
                    {{ __('messages.join_autoone') }}
                </span>
                <h1 class="text-5xl font-bold mt-6 leading-tight">
                    {{ __('messages.create_autoone_account') }}
                </h1>
                <p class="mt-6 text-lg text-gray-300 leading-8">
                    {{ __('messages.register_description') }}
                </p>

                <div class="grid grid-cols-2 gap-8 mt-12">
                    <div>
                        <h2 class="text-3xl font-bold">25K+</h2>
                        <p class="text-gray-300 mt-2">{{ __('messages.happy_customers') }}</p>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">500+</h2>
                        <p class="text-gray-300 mt-2">{{ __('messages.vehicles_available') }}</p>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">150+</h2>
                        <p class="text-gray-300 mt-2">{{ __('messages.workshop_partners') }}</p>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">12</h2>
                        <p class="text-gray-300 mt-2">{{ __('messages.countries_served') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 lg:p-16">
            <div class="w-full max-w-md">
                @include('language_drop_down')
                <h2 class="text-3xl font-bold">{{ __('messages.create_account') }}</h2>
                <p class="text-gray-500 mt-2 mb-8">{{ __('messages.join_under_minute') }}</p>
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
                        <!-- Name Fields -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-gray-700">{{ __('messages.first_name') }}</label>
                                <input type="text" name="first_name"
                                    class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                    required>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">{{ __('messages.last_name') }}</label>
                                <input type="text" name="last_name"
                                    class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                    required>
                            </div>
                        </div>

                        <!-- Other Fields -->
                        <div>
                            <label class="block font-medium text-gray-700">{{ __('messages.email_address') }}</label>
                            <input type="email" name="email"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">{{ __('messages.phone_number') }}</label>
                            <input type="tel" name="phone"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Profile Picture</label>
                            <input type="file" name="profile_picture"
                                class="w-full border rounded-lg px-4 py-2 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                accept="image/*">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">{{ __('messages.password') }}</label>
                            <input type="password" name="password"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block font-medium text-gray-700">
                                Account Type
                            </label>

                            <select id="role" name="role"
                                class="w-full border rounded-lg px-4 py-3 mt-1 focus:ring-2 focus:ring-red-500 outline-none"
                                required>
                                <option value="customer">Customer</option>
                                <option value="vendor">Vendor</option>
                            </select>
                        </div>

                        <!-- Vendor Information -->
                        <div id="vendorFields" class="hidden space-y-5 mt-5">

                            <div>
                                <label class="block font-medium text-gray-700">Vendor Type</label>
                                <select name="vendor_type" class="w-full border rounded-lg px-4 py-3 mt-1">
                                    <option value="">Select Vendor Type</option>
                                    <option value="service">Service(Workshop & Car Wash)</option>
                                    <option value="dealer">Car Dealer</option>
                                    <option value="rental">Car Rental</option>
                                    <option value="car_importer">Car Importer</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Business Name</label>
                                <input type="text" name="business_name"
                                    class="w-full border rounded-lg px-4 py-3 mt-1">
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Trade License</label>
                                <input type="text" name="trade_license"
                                    class="w-full border rounded-lg px-4 py-3 mt-1">
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Business Address</label>
                                <textarea name="address" class="w-full border rounded-lg px-4 py-3 mt-1"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">

                                <div>
                                    <label class="block font-medium text-gray-700">City</label>
                                    <input type="text" name="city"
                                        class="w-full border rounded-lg px-4 py-3 mt-1">
                                </div>

                                <div>
                                    <label class="block font-medium text-gray-700">Country</label>
                                    <input type="text" name="country" value="Bangladesh"
                                        class="w-full border rounded-lg px-4 py-3 mt-1">
                                </div>

                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Business Logo</label>
                                <input type="file" name="logo" class="w-full border rounded-lg px-4 py-2 mt-1"
                                    accept="image/*">
                            </div>

                        </div>

                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                            {{ __('messages.create_account') }}
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
                        Continue with Google
                    </a>


                    {{-- <a href="{{ route('apple.login') }}"
                        class="mt-3 block text-center bg-gray-900 text-white py-3 rounded-lg hover:bg-black transition">
                        Continue with Apple
                    </a> --}}

                </div>

                <!-- Footer Login -->
                <p class="text-center mt-8 text-gray-600">
                    {{ __('messages.already_account') }}
                    <a href="/login"
                        class="text-red-600 font-semibold hover:underline ml-1">{{ __('messages.login') }}</a>
                </p>
                <div class="text-center mt-4">
                    <a href="/"
                        class="text-gray-500 hover:text-red-600 text-sm">{{ __('messages.back_home') }}</a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

<script>
    const role = document.getElementById('role');
    const vendorFields = document.getElementById('vendorFields');

    role.addEventListener('change', function() {

        if (this.value === 'vendor') {
            vendorFields.classList.remove('hidden');
        } else {
            vendorFields.classList.add('hidden');
        }

    });
</script>
