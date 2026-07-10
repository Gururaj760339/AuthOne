<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Wash | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar')

    <!-- Hero Section -->
    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1607861716497-e65ab29fc7ac?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <span class="bg-blue-600 px-4 py-2 rounded-full text-sm">
                {{ __('messages.car_wash_badge') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ __('messages.car_wash_title_1') }}
                <span class="text-blue-400">{{ __('messages.car_wash_title_2') }}</span>
                {{ __('messages.car_wash_title_3') }}
            </h1>

            <p class="text-gray-300 text-lg mt-6 max-w-2xl leading-8">
                {{ __('messages.car_wash_description') }}
            </p>

            <div class="flex flex-wrap gap-4 mt-10">
                @if (Auth::check())
                    <a href="/booking-form"
                        class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-semibold transition">
                        {{ __('messages.book_now') }}
                    </a>
                @else
                    <a href="/login"
                        class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-semibold transition">
                        {{ __('messages.book_now') }}
                    </a>
                @endif

                <a href="#packages"
                    class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                    {{ __('messages.view_packages') }}
                </a>
            </div>

        </div>

    </section>

    <!-- Packages -->

    <section id="packages" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">
                    {{ __('messages.car_wash_packages') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ __('messages.choose_package_text') }}
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">

                <div class="bg-white rounded-xl shadow-lg p-8">


                    <h3 class="text-2xl font-bold">
                        {{ __('messages.basic_wash') }}
                    </h3>

                    <p class="text-5xl font-bold text-blue-600 mt-6">
                        $15
                    </p>

                    <ul class="mt-8 space-y-3 text-gray-600">
                        <li>✔ {{ __('messages.basic_feature_1') }}</li>
                        <li>✔ {{ __('messages.basic_feature_2') }}</li>
                        <li>✔ {{ __('messages.basic_feature_3') }}</li>
                        <li>✔ {{ __('messages.basic_feature_4') }}</li>
                    </ul>

                    <button class="mt-8 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                        {{ __('messages.package_choose') }}
                    </button>

                </div>

                <div class="bg-blue-600 rounded-xl shadow-lg p-8 text-white scale-105">

                    <div class="bg-white text-blue-600 inline-block px-3 py-1 rounded-full text-sm">
                        {{ __('messages.most_popular') }}
                    </div>

                    <h3 class="text-2xl font-bold mt-4">
                        {{ __('messages.premium_wash') }}
                    </h3>

                    <p class="text-5xl font-bold mt-6">
                        $35
                    </p>

                    <ul class="mt-8 space-y-3">
                        <li>✔ {{ __('messages.premium_feature_1') }}</li>
                        <li>✔ {{ __('messages.premium_feature_2') }}</li>
                        <li>✔ {{ __('messages.premium_feature_3') }}</li>
                        <li>✔ {{ __('messages.premium_feature_4') }}</li>
                        <li>✔ {{ __('messages.premium_feature_5') }}</li>
                    </ul>

                    <button class="mt-8 w-full bg-white text-blue-600 py-3 rounded-lg font-semibold">
                        {{ __('messages.package_choose') }}
                    </button>

                </div>

                <div class="bg-white rounded-xl shadow-lg p-8">

                    <h3 class="text-2xl font-bold">
                        {{ __('messages.luxury_detail') }}
                    </h3>

                    <p class="text-5xl font-bold text-blue-600 mt-6">
                        $75
                    </p>

                    <ul class="mt-8 space-y-3 text-gray-600">
                        <li>✔ {{ __('messages.luxury_feature_1') }}</li>
                        <li>✔ {{ __('messages.luxury_feature_2') }}</li>
                        <li>✔ {{ __('messages.luxury_feature_3') }}</li>
                        <li>✔ {{ __('messages.luxury_feature_4') }}</li>
                        <li>✔ {{ __('messages.luxury_feature_5') }}</li>
                    </ul>

                    <button class="mt-8 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                        {{ __('messages.package_choose') }}
                    </button>
                </div>

            </div>

        </div>

    </section>

    <!-- Features -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>

            <div>

                <h2 class="text-4xl font-bold">
                    {{ __('messages.why_choose') }}
                </h2>

                <div class="space-y-6 mt-10">

                    <div>
                        <h4 class="font-bold text-xl">
                            💧 {{ __('messages.feature_title_1') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ __('messages.feature_desc_1') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl">
                            ✨ {{ __('messages.feature_title_2') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ __('messages.feature_desc_2') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl">
                            ⚡ {{ __('messages.feature_title_3') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ __('messages.feature_desc_3') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl">
                            🛡 {{ __('messages.feature_title_4') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ __('messages.feature_desc_4') }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Process -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.how_it_works') }}
            </h2>

            <div class="grid md:grid-cols-4 gap-8 mt-14 text-center">

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        1

                    </div>


                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.step_1') }}
                    </h4>


                </div>

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        2

                    </div>


                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.step_2') }}
                    </h4>

                </div>

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        3

                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.step_3') }}
                    </h4>

                </div>

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        4

                    </div>


                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.step_4') }}
                    </h4>

                </div>

            </div>

        </div>

    </section>

    <!-- Reviews -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.customer_reviews') }}
            </h2>


            <div class="grid md:grid-cols-3 gap-8 mt-14">

                <div class="bg-gray-100 rounded-xl p-8">

                    ⭐⭐⭐⭐⭐

                    <<p class="mt-4 text-gray-600">
                        {{ __('messages.review_1') }}
                        </p>

                        <h4 class="mt-6 font-bold">

                            Ali Hassan

                        </h4>

                </div>

                <div class="bg-gray-100 rounded-xl p-8">

                    ⭐⭐⭐⭐⭐

                    <p class="mt-4 text-gray-600">
                        {{ __('messages.review_2') }}
                    </p>

                    <h4 class="mt-6 font-bold">

                        Emma Wilson

                    </h4>

                </div>

                <div class="bg-gray-100 rounded-xl p-8">

                    ⭐⭐⭐⭐⭐

                    <p class="mt-4 text-gray-600">
                        {{ __('messages.review_3') }}
                    </p>

                    <h4 class="mt-6 font-bold">

                        Mohammed Saleh

                    </h4>

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

                <div class="bg-white shadow rounded-lg p-6">

                    <h4 class="font-bold">
                        {{ __('messages.faq_q1') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.faq_a1') }}
                    </p>

                </div>

                <div class="bg-white shadow rounded-lg p-6">

                    <h4 class="font-bold">
                        {{ __('messages.faq_q2') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.faq_a2') }}
                    </p>

                </div>

                <div class="bg-white shadow rounded-lg p-6">

                    <h4 class="font-bold">
                        {{ __('messages.faq_q3') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.faq_a3') }}
                    </p>

                </div>

            </div>

        </div>

    </section>
    <!-- CTA -->

    <!-- CTA -->

    <section class="bg-blue-600 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold">
                {{ __('messages.cta_title') }}
            </h2>

            <p class="mt-5 text-blue-100 text-lg">
                {{ __('messages.cta_description') }}
            </p>

            @if (Auth::check())
                <a href="/booking-form"
                    class="inline-block mt-8 bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
                    {{ __('messages.book_car_wash') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
                    {{ __('messages.book_car_wash') }}
                </a>
            @endif

        </div>

    </section>

</body>

</html>
