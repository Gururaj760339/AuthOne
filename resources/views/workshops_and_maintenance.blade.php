<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshops & Maintenance | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50">
    @include('navbar')

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1486006920555-c77dcf18193c?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <!-- Hero -->

            <span class="bg-red-600 px-4 py-2 rounded-full text-sm">
                {{ __('messages.trusted_auto_service') }}
            </span>

            <h1 class="text-5xl font-bold mt-6 leading-tight">
                {{ __('messages.workshops_maintenance') }}
            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg leading-8">
                {{ __('messages.maintenance_description') }}
            </p>

            <div class="mt-10 flex flex-wrap gap-4">
                @if (Auth::check())
                    <a href="/booking-form" class="bg-red-600 hover:bg-red-700 px-7 py-4 rounded-lg font-semibold transition">
                        {{ __('messages.book_maintenance') }}
                    </a>
                @else
                    <a href="/login" class="bg-red-600 hover:bg-red-700 px-7 py-4 rounded-lg font-semibold transition">
                        {{ __('messages.book_maintenance') }}
                    </a>
                @endif


                <a href="#services"
                    class="border border-white px-7 py-4 rounded-lg hover:bg-white hover:text-black transition">
                    {{ __('messages.explore_services') }}
                </a>

            </div>

        </div>

    </section>

    <!-- Services -->

    <section id="services" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">
                    {{ __('messages.our_maintenance_services') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ __('messages.maintenance_services_desc') }}
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-14">

                <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">

                    <div class="text-5xl mb-5">🔧</div>

                    <h3 class="font-bold text-xl">
                        {{ __('messages.engine_repair') }}
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ __('messages.engine_repair_desc') }}
                    </p>

                </div>

                <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">

                    <div class="text-5xl mb-5">🛞</div>

                    <h3 class="font-bold text-xl">
                        {{ __('messages.tire_services') }}
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ __('messages.tire_services_desc') }}
                    </p>

                </div>

                <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">

                    <div class="text-5xl mb-5">🛢️</div>

                    <h3 class="font-bold text-xl">
                        {{ __('messages.oil_change') }}
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ __('messages.oil_change_desc') }}
                    </p>

                </div>

                <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">

                    <div class="text-5xl mb-5">🚗</div>

                    <h3 class="font-bold text-xl">
                        {{ __('messages.brake_inspection') }}
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ __('messages.brake_inspection_desc') }}
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- Why Choose -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>

            <div>

                <h2 class="text-4xl font-bold">
                    {{ __('messages.why_choose_workshop') }}
                </h2>

                <div class="space-y-6 mt-10">

                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.certified_technicians') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.certified_technicians_desc') }}
                        </p>

                    </div>

                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.genuine_parts') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.genuine_parts_desc') }}
                        </p>

                    </div>

                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.transparent_pricing') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.transparent_pricing_desc') }}
                        </p>

                    </div>

                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.warranty_included') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.warranty_included_desc') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Process -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-center text-4xl font-bold">
                {{ __('messages.how_it_works') }}
            </h2>

            <div class="grid md:grid-cols-4 gap-8 mt-14">

                <div class="text-center">

                    <div
                        class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto text-xl font-bold">

                        1

                    </div>

                    <h4 class="font-bold mt-6">

                        {{ __('messages.book_service') }}


                    </h4>

                </div>

                <div class="text-center">

                    <div
                        class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto text-xl font-bold">

                        2

                    </div>

                    <h4 class="font-bold mt-6">

                        {{ __('messages.vehicle_inspection') }}

                    </h4>

                </div>

                <div class="text-center">

                    <div
                        class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto text-xl font-bold">

                        3

                    </div>

                    <h4 class="font-bold mt-6">

                        {{ __('messages.maintenance') }}

                    </h4>

                </div>

                <div class="text-center">

                    <div
                        class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto text-xl font-bold">

                        4

                    </div>

                    <h4 class="font-bold mt-6">

                        {{ __('messages.ready_for_pickup') }}

                    </h4>

                </div>

            </div>

        </div>

    </section>

    <!-- Reviews -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-center text-4xl font-bold">
                {{ __('messages.customer_reviews') }}
            </h2>

            <div class="grid md:grid-cols-3 gap-8 mt-14">

                <div class="bg-gray-100 rounded-xl p-8">

                    ⭐⭐⭐⭐⭐

                    <p class="mt-4 text-gray-600">

                        {{ __('messages.review1') }}
                    </p>

                    <h5 class="mt-6 font-bold">

                        Ahmed Al Mansoori

                    </h5>

                </div>

                <div class="bg-gray-100 rounded-xl p-8">

                    ⭐⭐⭐⭐⭐

                    <p class="mt-4 text-gray-600">

                        {{ __('messages.review2') }}

                    </p>

                    <h5 class="mt-6 font-bold">

                        Sarah Johnson

                    </h5>

                </div>

                <div class="bg-gray-100 rounded-xl p-8">

                    ⭐⭐⭐⭐⭐

                    <p class="mt-4 text-gray-600">

                        {{ __('messages.review3') }}

                    </p>

                    <h5 class="mt-6 font-bold">

                        Mohammed Khalid

                    </h5>

                </div>

            </div>

        </div>

    </section>

    <!-- FAQ -->

    <section class="py-20">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.faq') }}
            </h2>

            <div class="space-y-6 mt-12">

                <div class="bg-white rounded-lg shadow p-6">

                    <h4 class="font-bold">
                        {{ __('messages.faq1') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.faq1_ans') }}
                    </p>

                </div>

                <div class="bg-white rounded-lg shadow p-6">

                    <h4 class="font-bold">
                        {{ __('messages.faq2') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.faq2_ans') }}
                    </p>

                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h4 class="font-bold">
                        {{ __('messages.faq3') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.faq3_ans') }}
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->

    <section class="bg-red-600 py-20 text-center text-white">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold">
                {{ __('messages.keep_car_perfect') }}
            </h2>

            <p class="mt-5 text-red-100 text-lg">
                {{ __('messages.keep_car_desc') }}
            </p>

            @if (Auth::check())
                <a href="/booking-form"
                    class="inline-block mt-8 bg-white text-red-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition">
                    {{ __('messages.book_appointment') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-white text-red-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition">
                    {{ __('messages.book_appointment') }}
                </a>
            @endif


        </div>

    </section>

</body>

</html>
