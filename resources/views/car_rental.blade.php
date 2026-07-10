<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar')

    <!-- ================= HERO ================= -->

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <span class="bg-yellow-500 text-black px-4 py-2 rounded-full text-sm font-semibold">
                {{ __('messages.premium_car_rental') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ __('messages.rent_perfect_car') }}
            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg leading-8">
                {{ __('messages.rental_description') }}
            </p>

            <div class="flex gap-4 mt-10 flex-wrap">

                <a href="#cars"
                    class="bg-yellow-500 text-black px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition">
                    {{ __('messages.browse_cars') }}
                </a>

                @if (Auth::check())
                    <a href="/rent-car-booking-form"
                        class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                        {{ __('messages.book_now') }}
                    </a>
                @else
                    <a href="/login"
                        class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                        {{ __('messages.book_now') }}
                    </a>
                @endif
            </div>

        </div>

    </section>

    <!-- ================= SEARCH ================= -->

    <section class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="grid md:grid-cols-4 gap-4">

                <input type="text" placeholder="{{ __('messages.pickup_location') }}"
                    class="border rounded-lg px-4 py-3">

                <input type="date" class="border rounded-lg px-4 py-3">

                <input type="date" class="border rounded-lg px-4 py-3">

                <button class="bg-yellow-500 hover:bg-yellow-400 rounded-lg font-semibold">
                    {{ __('messages.search_cars') }}
                </button>

            </div>

        </div>

    </section>

    <!-- ================= RENTAL CARS ================= -->

    <section id="cars" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">
                    {{ __('messages.available_rental_cars') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ __('messages.choose_range_cars') }}
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">

                <!-- Card -->

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=900&q=80">

                    <div class="p-6">

                        <h3 class="text-2xl font-bold">
                            {{ __('messages.toyota_corolla') }}
                        </h3>

                        <p class="text-gray-600 mt-3">
                            {{ __('messages.corolla_details') }}
                        </p>

                        <div class="flex justify-between items-center mt-6">

                            <div>

                                <p class="text-gray-500 text-sm">
                                    {{ __('messages.starting_from') }}
                                </p>

                                <p class="text-3xl font-bold text-yellow-500">
                                    $45/day
                                </p>

                            </div>

                            @if (Auth::check())
                                <a class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                    {{ __('messages.rent_now') }}
                                </a>
                            @else
                                <a href="/login"
                                    class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                    {{ __('messages.rent_now') }}
                                </a>
                            @endif


                        </div>

                    </div>

                </div>

                <!-- Card -->

                <!-- BMW X5 Card -->

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=900&q=80">

                    <div class="p-6">

                        <h3 class="text-2xl font-bold">
                            {{ __('messages.bmw_x5') }}
                        </h3>

                        <p class="text-gray-600 mt-3">
                            {{ __('messages.bmw_details') }}
                        </p>

                        <div class="flex justify-between items-center mt-6">

                            <div>

                                <p class="text-gray-500 text-sm">
                                    {{ __('messages.starting_from') }}
                                </p>

                                <p class="text-3xl font-bold text-yellow-500">
                                    $120/Day
                                </p>

                            </div>

                            @if (Auth::check())
                                <a class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                    {{ __('messages.rent_now') }}
                                </a>
                            @else
                                <a href="/login"
                                    class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                    {{ __('messages.rent_now') }}
                                </a>
                            @endif

                        </div>

                    </div>

                </div>


                <!-- Mercedes C-Class Card -->

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80">

                    <div class="p-6">

                        <h3 class="text-2xl font-bold">
                            {{ __('messages.mercedes_c') }}
                        </h3>

                        <p class="text-gray-600 mt-3">
                            {{ __('messages.mercedes_details') }}
                        </p>

                        <div class="flex justify-between items-center mt-6">

                            <div>

                                <p class="text-gray-500 text-sm">
                                    {{ __('messages.starting_from') }}
                                </p>

                                <p class="text-3xl font-bold text-yellow-500">
                                    $150/Day
                                </p>

                            </div>

                            @if (Auth::check())
                                <a class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                    {{ __('messages.rent_now') }}
                                </a>
                            @else
                                <a href="/login"
                                    class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                    {{ __('messages.rent_now') }}
                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= WHY CHOOSE ================= -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>

            <div>

                <h2 class="text-4xl font-bold">
                    {{ __('messages.why_rent') }}
                </h2>

                <div class="space-y-6 mt-10">

                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.insured') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.insured_desc') }}
                        </p>

                    </div>


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.roadside') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.roadside_desc') }}
                        </p>

                    </div>


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.flexible_plans') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.flexible_plans_desc') }}
                        </p>

                    </div>


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.no_hidden') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.no_hidden_desc') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= HOW IT WORKS ================= -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.how_it_works') }}
            </h2>


            <div class="grid md:grid-cols-4 gap-8 mt-14">


                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        1

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ __('messages.choose_vehicle') }}
                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        2

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ __('messages.select_dates') }}
                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        3

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ __('messages.confirm_booking') }}
                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        4

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ __('messages.pickup_drive') }}
                    </h4>

                </div>


            </div>

        </div>

    </section>

    <!-- ================= FAQ ================= -->
    <section class="bg-white py-20">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.faq') }}
            </h2>


            <div class="space-y-6 mt-12">


                <div class="bg-gray-100 rounded-lg p-6">

                    <h4 class="font-bold">
                        {{ __('messages.documents_required') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.documents_answer') }}
                    </p>

                </div>



                <div class="bg-gray-100 rounded-lg p-6">

                    <h4 class="font-bold">
                        {{ __('messages.extend_rental') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.extend_answer') }}
                    </p>

                </div>



                <div class="bg-gray-100 rounded-lg p-6">

                    <h4 class="font-bold">
                        {{ __('messages.insurance') }}
                    </h4>

                    <p class="text-gray-600 mt-2">
                        {{ __('messages.insurance_answer') }}
                    </p>

                </div>


            </div>

        </div>

    </section>

    <!-- ================= CTA ================= -->

    <section id="booking" class="bg-yellow-500 py-20">

        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold">
                {{ __('messages.ready_journey') }}
            </h2>


            <p class="mt-5 text-lg">
                {{ __('messages.journey_desc') }}
            </p>


            @if (Auth::check())
                <a href="/rent-car-booking-form"
                    class="inline-block mt-8 bg-black text-white px-8 py-4 rounded-lg hover:bg-gray-800 transition">
                    {{ __('messages.reserve_car') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-black text-white px-8 py-4 rounded-lg hover:bg-gray-800 transition">
                    {{ __('messages.reserve_car') }}
                </a>
            @endif


        </div>

    </section>

</body>

</html>
