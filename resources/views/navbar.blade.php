<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-3xl font-bold text-blue-700">
                    AutoOne
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden xl:flex items-center gap-4 text-sm font-medium text-gray-700">

                <a href="/" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.home') }}
                </a>

                <a href="/workshops-and-maintenance" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.workshops') }}
                </a>

                <a href="/car-wash" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.car_wash') }}
                </a>

                <a href="/buy-finance-cars" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.buy_cars') }}
                </a>

                <a href="/car-rental" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.car_rental') }}
                </a>

                <a href="/car-imports" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.car_imports') }}
                </a>

                <a href="/contact" class="hover:text-blue-600 transition whitespace-nowrap">
                    {{ __('messages.contact') }}
                </a>

            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-3">

                <div class="hidden md:flex items-center gap-2">

                    @if (Auth::check())
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    @else
                        <a href="/login"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                            {{ __('messages.login') }}
                        </a>
                    @endif


                    <a href="/registration"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                        {{ __('messages.register') }}
                    </a>

                </div>

                @include('language_drop_down')

            </div>

        </div>
    </div>
</nav>
