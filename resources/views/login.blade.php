<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Background -->

    <div class="min-h-screen flex">

        <!-- Left Side -->

        <div class="hidden lg:flex w-1/2 relative">

            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d?auto=format&fit=crop&w=1600&q=80"
                class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-slate-900/70"></div>

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">

                <span class="bg-red-600 w-fit px-4 py-2 rounded-full text-sm">
                    {{ __('messages.welcome_autoone') }}
                </span>

                <h1 class="text-5xl font-bold mt-6 leading-tight">
                    {{ __('messages.automotive_journey') }}
                </h1>

                <p class="mt-6 text-gray-300 text-lg leading-8">
                    {{ __('messages.login_description') }}
                </p>

                <div class="flex gap-10 mt-10">

                    <div>
                        <h2 class="text-3xl font-bold">
                            25K+
                        </h2>

                        <p class="text-gray-300">
                            {{ __('messages.happy_customers') }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold">
                            2,500+
                        </h2>

                        <p class="text-gray-300">
                            {{ __('messages.cars_sold') }}
                        </p>
                    </div>

                </div>

            </div>

        </div>


        <!-- Right Side -->

        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-10">

            <div class="bg-white shadow-2xl rounded-2xl w-full max-w-md p-10">

                @include('language_drop_down')

                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-red-600 text-white flex items-center justify-center text-2xl font-bold mx-auto">
                        A
                    </div>

                    <h2 class="text-3xl font-bold mt-6">
                        {{ __('messages.welcome_back') }}
                    </h2>

                    <p class="text-gray-500 mt-2">
                        {{ __('messages.sign_in_account') }}
                    </p>

                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.login') }}" method="POST" class="mt-10 space-y-6">
                    @csrf
                    <!-- Email -->
                    <div>

                        <label class="font-medium text-gray-700">
                            {{ __('messages.email_address') }}
                        </label>

                        <input name="email" type="email" placeholder="{{ __('messages.enter_email') }}"
                            class="mt-2 w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none">

                    </div>

                    <!-- Password -->

                    <div>

                        <label class="font-medium text-gray-700">
                            {{ __('messages.password') }}
                        </label>

                        <input name="password" type="password" placeholder="{{ __('messages.enter_password') }}"
                            class="mt-2 w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none">

                    </div>

                    <!-- Forgot Password -->
                    <div class="flex items-center justify-between">

                        <a href="#" class="text-red-600 hover:underline">
                            {{ __('messages.forgot_password') }}
                        </a>

                    </div>

                    <!-- Login Button -->

                    <button
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                        {{ __('messages.login') }}
                    </button>

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
                        class="mt-4 block text-center bg-red-600 text-white py-3 rounded-lg">
                        Continue with Google
                    </a>


                    {{-- <a href="{{ route('apple.login') }}"
                        class="mt-3 block text-center bg-black text-white py-3 rounded-lg">
                        Continue with Apple
                    </a> --}}

                </div>

                <!-- Divider -->

                <div class="flex items-center gap-4 my-8">

                    <hr class="flex-1">

                    <span class="text-gray-500">
                        {{ __('messages.or') }}
                    </span>

                    <hr class="flex-1">

                </div>

                <!-- Register -->

                <p class="text-center mt-8 text-gray-600">

                    {{ __('messages.dont_have_account') }}

                    <a href="/registration" class="text-red-600 font-semibold hover:underline">

                        {{ __('messages.create_account') }}

                    </a>

                </p>

                <!-- Home -->

                <div class="text-center mt-6">

                    <a href="/" class="text-gray-500 hover:text-red-600">

                        {{ __('messages.back_home') }}

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
