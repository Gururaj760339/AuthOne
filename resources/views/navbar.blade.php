<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-3xl font-bold text-blue-700">
                    {{ optional($setting)->website_name ?? 'AutoOne' }}
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-4 text-sm font-medium text-gray-700">

                <a href="/" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Home') }}
                </a>

                <a href="{{ route('customer.workshops.maintenance.show') }}"
                    class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Workshops') }}
                </a>

                <a href="{{ route('customer.carwash') }}" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Car Wash') }}
                </a>

                <a href="{{ route('customer.cars') }}" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Buy Cars') }}
                </a>

                <a href="{{ route('customer.rental') }}" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Car Rental') }}
                </a>

                <a href="{{ route('customer.import.request') }}"
                    class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Car Imports') }}
                </a>

                <a href="{{ route('customer.contact') }}" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ translate('Contact') }}
                </a>

            </div>

            <button id="menu-btn" class="lg:hidden text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            @if (Auth::check())
                <a href="{{ route('customer.profile') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition whitespace-nowrap">
                    {{ translate('My Profile') }}
                </a>
            @endif

            <!-- Right Side -->
            <div class="flex items-center gap-3">

                <div class="hidden md:flex items-center gap-2">

                    @if (Auth::check())
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition whitespace-nowrap">
                                {{ translate('Logout') }}
                            </button>
                        </form>
                    @else
                        <a href="/login"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                            {{ translate('Login') }}
                        </a>
                    @endif

                    <a href="/registration"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                        {{ translate('Register') }}
                    </a>

                </div>

                @include('ai_layer.ai_language_translate')

            </div>

        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="hidden lg:hidden bg-white shadow-xl border-t border-gray-200">

    <div class="px-5 py-4 space-y-2">

        <a href="/"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">🏠</span>
            <span>{{ translate('Home') }}</span>
        </a>

        <a href="{{ route('customer.workshops.maintenance.show') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">🔧</span>
            <span>{{ translate('Workshops') }}</span>
        </a>

        <a href="{{ route('customer.carwash') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">🧽</span>
            <span>{{ translate('Car Wash') }}</span>
        </a>

        <a href="{{ route('customer.cars') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">🚘</span>
            <span>{{ translate('Buy Cars') }}</span>
        </a>

        <a href="{{ route('customer.rental') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">🚗</span>
            <span>{{ translate('Car Rental') }}</span>
        </a>

        <a href="{{ route('customer.import.request') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">🌍</span>
            <span>{{ translate('Car Imports') }}</span>
        </a>

        <a href="{{ route('customer.contact') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition">
            <span class="text-xl">📞</span>
            <span>{{ translate('Contact') }}</span>
        </a>

    </div>

    <div class="border-t border-gray-200 p-5">

        @guest

            <a href="/login"
                class="block w-full text-center bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                {{ translate('Login') }}
            </a>

            <a href="/registration"
                class="block w-full text-center mt-3 border border-blue-600 text-blue-600 py-3 rounded-xl font-semibold hover:bg-blue-600 hover:text-white transition">
                {{ translate('Register') }}
            </a>

        @else

            <a href="{{ route('customer.profile') }}"
                class="block w-full text-center mb-3 bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                {{ translate('My Profile') }}
            </a>

            <form action="{{ route('user.logout') }}" method="POST">
                @csrf

                <button class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition">
                    {{ translate('Logout') }}
                </button>
            </form>

        @endguest

    </div>

</div>