<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoOne | Premium Automotive Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 {{ app()->getLocale() == 'ar' ? 'font-arabic' : 'font-sans' }}">
    <!-- ================= NAVBAR ================= -->
    @include('navbar', ['setting' => $setting])

    <!-- ================= HERO ================= -->
    <section class="bg-gradient-to-r from-blue-900 to-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="bg-blue-500 px-4 py-2 rounded-full">
                        {{ translate('Trusted Platform') }}
                    </span>

                    <h1 class="text-5xl font-bold mt-6 leading-tight">
                        {{ translate('Premium Automotive Services') }}
                    </h1>

                    <p class="mt-6 text-lg text-gray-200">
                        {{ translate('Find trusted workshops, premium rental cars, car financing, imports and maintenance services all in one place.') }}
                    </p>

                    <div class="mt-8 flex gap-4">
                        <a href="#services" class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold">
                            {{ translate('Browse Services') }}
                        </a>

                        <a href="#cars" class="border border-white px-6 py-3 rounded-lg">
                            {{ translate('Browse Cars') }}
                        </a>
                    </div>
                </div>

                <div>
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900"
                        class="rounded-xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SERVICES ================= -->
    <section class="py-20">
        <div id="services" class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="text-4xl font-bold">
                    {{ translate('Our Services') }}
                </h2>

                <p class="text-gray-500 mt-3">
                    {{ translate('Everything you need for your vehicle in one platform.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-6">
                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🚗
                    <h3 class="font-bold mt-4">{{ translate('Workshop') }}</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        {{ translate('Maintenance & Repairs') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🧽
                    <h3 class="font-bold mt-4">{{ translate('Car Wash') }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ translate('Professional Cleaning') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🚘
                    <h3 class="font-bold mt-4">{{ translate('Buy Cars') }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ translate('New & Used Cars') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    💳
                    <h3 class="font-bold mt-4">{{ translate('Finance') }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ translate('Flexible Payment Plans') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🌍
                    <h3 class="font-bold mt-4">{{ translate('Import Cars') }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ translate('Japan • Germany • USA') }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= STATS ================= -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-4 gap-8 text-center">
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">500+</h2>
                    <p>{{ translate('Certified Workshops') }}</p>
                </div>
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">10K+</h2>
                    <p class="mt-3">{{ translate('Happy Customers') }}</p>
                </div>
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">15+</h2>
                    <p class="mt-3">{{ translate('Countries Served') }}</p>
                </div>
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">24/7</h2>
                    <p class="mt-3">{{ translate('Customer Support') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= TESTIMONIAL ================= -->
    <section class="bg-blue-700 text-white py-20">
        <div class="max-w-5xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold">
                {{ translate('What Our Customers Say') }}
            </h2>
            <p class="mt-10 text-xl">★★★★★</p>
            <p class="mt-4 text-lg">"{{ translate('testimonial') }}"</p>
            <p class="mt-8 font-semibold">{{ translate('Ahmed Hassan — Dubai') }}</p>
        </div>
    </section>

    @include('ai_layer.chatbot')

    <!-- ================= CTA ================= -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto bg-blue-600 rounded-2xl text-white p-14 text-center">
            <h2 class="text-4xl font-bold">{{ translate('ready_title') }}</h2>
            <p class="mt-5">{{ translate('Ready Description') }}</p>
            <div class="mt-8">
                @if (Auth::check())
                    <a href="/buy-finance-cars"
                        class="bg-white text-blue-700 px-8 py-3 rounded-lg font-bold">{{ translate('Get Started') }}</a>
                @else
                    <a href="/login"
                        class="bg-white text-blue-700 px-8 py-3 rounded-lg font-bold">{{ translate('Get Started') }}</a>
                @endif
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- About -->
                <div>
                    <h2 class="text-2xl font-bold text-white">AutoOne</h2>
                    <p class="mt-4 text-gray-400">
                        {{ translate('footer_description') }}
                    </p>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-white font-bold mb-4">
                        {{ translate('services') }}
                    </h3>

                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('customer.workshops.maintenance.show') }}"
                            class="hover:text-red-500 transition">
                            {{ translate('workshop') }}
                        </a>

                        <a href="{{ route('customer.carwash') }}" class="hover:text-red-500 transition">
                            {{ translate('car_wash') }}
                        </a>

                        <a href="{{ route('customer.rental') }}" class="hover:text-red-500 transition">
                            {{ translate('rental') }}
                        </a>

                        <a href="{{ route('customer.cars') }}" class="hover:text-red-500 transition">
                            {{ translate('finance') }}
                        </a>
                    </div>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-white font-bold mb-4">
                        {{ translate('company') }}
                    </h3>

                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('customer.about') }}" class="hover:text-red-500 transition">
                            {{ translate('about') }}
                        </a>

                        <a href="{{ route('customer.faq') }}" class="hover:text-red-500 transition">
                            {{ translate('faq') }}
                        </a>

                        <a href="{{ route('customer.contact') }}" class="hover:text-red-500 transition">
                            {{ translate('contact') }}
                        </a>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-bold mb-4">
                        {{ translate('contact') }}
                    </h3>

                    <div class="space-y-2 text-gray-400">
                        <p>{{ optional($setting)->address ?? 'Address not available' }}</p>
                        <p>{{ optional($setting)->email ?? 'Email not available' }}</p>
                        <p>{{ optional($setting)->phone ?? 'Phone not available' }}</p>
                    </div>
                </div>

            </div>

            <!-- Bottom -->
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400">
                {{ translate('© 2026 AutoOne. All Rights Reserved.') }}
            </div>
        </div>
    </footer>
</body>

</html>


<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
