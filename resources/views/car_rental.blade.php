<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar', ['setting' => $setting])

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
                    <a href="{{ route('customer.rental.booking.create') }}"
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

                <form action="{{ route('customer.rentals.car.search') }}" method="GET"
                    class="bg-white p-6 rounded-xl shadow-md mb-8">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div class="md:col-span-3">
                            <input type="text" name="city" value="{{ request('city') }}" placeholder="Enter City"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-3 py-3 transition">
                            Search
                        </button>

                    </div>

                </form>

                <!-- Card -->
                @foreach ($rentals as $rental)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                        <img src="{{ asset('storage/' . $rental->car->thumbnail) }}">

                        <div class="p-6">

                            <h3 class="text-2xl font-bold">
                                {{ $rental->car->title }}
                            </h3>

                            <p class="text-gray-600 mt-3">
                                {{ $rental->car->transmission . ' • ' . $rental->car->fuel_type . ' • ' . $rental->car->mileage }}
                            </p>

                            <div class="flex justify-between items-center mt-6">

                                <div>

                                    <p class="text-gray-500 text-sm">
                                        {{ __('messages.starting_from') }}
                                    </p>

                                    <p class="text-3xl font-bold text-yellow-500">
                                        ${{ $rental->price_per_day }}/day
                                    </p>

                                </div>

                                @if (Auth::check())
                                    <a href="{{ route('customer.single.rental.bookin.create', $rental->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
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
                @endforeach


            </div>

            <h2 class="text-3xl font-bold mb-6">P2P Rental Cars</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach ($userCars as $car)
                    <div class="bg-white rounded-lg shadow">

                        <img src="{{ asset('storage/' . $car->main_image) }}"
                            class="w-full h-52 object-cover rounded-t-lg">

                        <div class="p-5">

                            <h3 class="text-xl font-bold">
                                {{ $car->brand }} {{ $car->model }}
                            </h3>

                            <p class="text-gray-600">
                                Owner: {{ $car->user->name }}
                            </p>

                            <p class="font-semibold mt-2">
                                ${{ $car->price_per_day }}/Day
                            </p>

                            @if (Auth::check())
                                <a href="{{ route('p2p.booking.create', $car->id) }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                                Rent Now
                            </a>
                            @else
                                <a href="/login" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                                Rent Now
                            </a>
                            @endif

                        </div>

                    </div>
                @endforeach

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

    @include('ai_layer.chatbot')

    @if (Auth::check() && $rental_booking && $rental_booking->status == 'Completed')
        <div class="max-w-2xl mx-auto mt-10">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">

                <div class="text-center">

                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                        </svg>
                    </div>

                    <h2 class="text-3xl font-bold mt-5">
                        Leave Your Review
                    </h2>

                    <p class="text-gray-500 mt-2">
                        We'd love to hear about your experience.
                    </p>

                </div>


                <form action="{{ route('customer.store.review') }}" method="POST" enctype="multipart/form-data"
                    class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label class="block mb-2 font-semibold">
                            Your Name
                        </label>

                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full border rounded-lg p-3" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            Location
                        </label>

                        <input type="text" name="location" placeholder="Dhaka, Bangladesh"
                            class="w-full border rounded-lg p-3" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            Rating
                        </label>

                        <select name="rating" class="w-full border rounded-lg p-3" required>

                            <option value="">Select Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4">⭐⭐⭐⭐ Very Good</option>
                            <option value="3">⭐⭐⭐ Good</option>
                            <option value="2">⭐⭐ Fair</option>
                            <option value="1">⭐ Poor</option>

                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            Review
                        </label>

                        <textarea name="review" rows="5" class="w-full border rounded-lg p-3" placeholder="Write your review..."
                            required></textarea>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            Image
                        </label>

                        <input type="file" name="image" class="w-full border rounded-lg p-3">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                        Submit Review
                    </button>

                </form>

            </div>
        </div>
    @endif

    <!-- ================= FAQ ================= -->
    <section class="bg-white py-20">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.faq') }}
            </h2>


            <div class="space-y-6 mt-12">

                @foreach ($faqs as $faq)
                    <div class="bg-gray-100 rounded-lg p-6">

                        <h4 class="font-bold">
                            {{ $faq->question }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ $faq->answer }}
                        </p>

                    </div>
                @endforeach
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
                <a href="{{ route('customer.rental.booking.create') }}"
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

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
