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
    @include('navbar')
    

    <!-- ================= HERO ================= -->
    <section class="bg-gradient-to-r from-blue-900 to-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="bg-blue-500 px-4 py-2 rounded-full">{{ __('messages.trusted_platform') }}</span>
                    <h1 class="text-5xl font-bold mt-6 leading-tight">
                        {{ __('messages.hero_title') }}
                    </h1>

                    <p class="mt-6 text-lg text-gray-200">
                        {{ __('messages.hero_description') }}
                    </p>

                    <div class="mt-8 flex gap-4">
                        <a href="#services"
                            class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold">
                            {{ __('messages.browse_services') }}</a>

                        <a href="#cars"
                            class="border border-white px-6 py-3 rounded-lg">
                            {{ __('messages.browse_cars') }}</a>
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
                <h2 class="text-4xl font-bold">{{ __('messages.our_services') }}</h2>
                <p class="text-gray-500 mt-3">{{ __('messages.services_description') }}</p>
            </div>

            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-6">
                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🚗
                    <h3 class="font-bold mt-4">{{ __('messages.workshop') }}</h3>
                    <p class="text-sm text-gray-500 mt-2">{{ __('messages.maintenance_repairs') }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🧽
                    <h3 class="font-bold mt-4">{{ __('messages.car_wash') }}</h3>
                    <p class="text-sm text-gray-500">{{ __('messages.professional_cleaning') }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🚘
                    <h3 class="font-bold mt-4">{{ __('messages.buy_cars') }}</h3>
                    <p class="text-sm text-gray-500">{{ __('messages.new_used') }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    💳
                    <h3 class="font-bold mt-4">{{ __('messages.finance') }}</h3>
                    <p class="text-sm text-gray-500">{{ __('messages.payment_plans') }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-8 text-center">
                    🌍
                    <h3 class="font-bold mt-4">{{ __('messages.import_cars') }}</h3>
                    <p class="text-sm text-gray-500">Japan • Germany • USA</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FEATURED CARS ================= -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between mb-10">
                <h2 class="text-4xl font-bold">{{ __('messages.featured_cars') }}</h2>
                <a href="#" class="text-blue-600">{{ __('messages.view_all') }} →</a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Example Card -->
                <div id="cars" class="bg-gray-100 rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900">
                    <div class="p-6">
                        <h3 class="text-xl font-bold">Toyota Camry 2024</h3>
                        <p class="text-gray-500 mt-2">Automatic • Petrol • 18,000 km</p>
                        <div class="flex justify-between mt-5">
                            <span class="text-blue-700 font-bold">AED 105,000</span>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('messages.details') }}</button>
                        </div>
                    </div>
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
                    <p class="mt-3">{{ __('messages.certified_workshops') }}</p>
                </div>
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">10K+</h2>
                    <p class="mt-3">{{ __('messages.happy_customers') }}</p>
                </div>
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">15+</h2>
                    <p class="mt-3">{{ __('messages.countries_served') }}</p>
                </div>
                <div>
                    <h2 class="text-5xl font-bold text-blue-600">24/7</h2>
                    <p class="mt-3">{{ __('messages.customer_support') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= TESTIMONIAL ================= -->
    <section class="bg-blue-700 text-white py-20">
        <div class="max-w-5xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold">{{ __('messages.what_customers_say') }}</h2>
            <p class="mt-10 text-xl">★★★★★</p>
            <p class="mt-4 text-lg">"{{ __('messages.testimonial') }}"</p>
            <p class="mt-8 font-semibold">Ahmed Hassan — Dubai</p>
        </div>
    </section>

    <!-- ================= CTA ================= -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto bg-blue-600 rounded-2xl text-white p-14 text-center">
            <h2 class="text-4xl font-bold">{{ __('messages.ready_title') }}</h2>
            <p class="mt-5">{{ __('messages.ready_description') }}</p>
            <div class="mt-8">
                <a href="/buy-finance-cars"
                    class="bg-white text-blue-700 px-8 py-3 rounded-lg font-bold">{{ __('messages.get_started') }}</a>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-14">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h2 class="text-2xl font-bold text-white">AutoOne</h2>
                    <p class="mt-4">{{ __('messages.footer_description') }}</p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">{{ __('messages.services') }}</h3>
                    <p>{{ __('messages.workshop') }}</p>
                    <p>{{ __('messages.car_wash') }}</p>
                    <p>Rental</p>
                    <p>{{ __('messages.finance') }}</p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">{{ __('messages.company') }}</h3>
                    <p>{{ __('messages.about') }}</p>
                    <p>{{ __('messages.faq') }}</p>
                    <p>{{ __('messages.contact') }}</p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">{{ __('messages.contact') }}</h3>
                    <p>Dubai, UAE</p>
                    <p>info@autoone.com</p>
                    <p>+971 55 123 4567</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-10 pt-6 text-center">
                {{ __('messages.copyright') }}
            </div>
        </div>
    </footer>
</body>

</html>


<script></script>
