<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Car Rental | AutoOne') }}</title>

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
                {{ translate('Premium Car Rental') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ translate('Rent Your Perfect Car') }}
            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg leading-8">
                {{ translate('Rental Description') }}
            </p>

            <div class="flex gap-4 mt-10 flex-wrap">

                <a href="#cars"
                    class="bg-yellow-500 text-black px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition">
                    {{ translate('Browse Cars') }}
                </a>

                @if (Auth::check())
                    <a href="{{ route('customer.rental.booking.create') }}"
                        class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                        {{ translate('Book Now') }}
                    </a>
                @else
                    <a href="/login"
                        class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                        {{ translate('Book Now') }}
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
                    {{ translate('Available Rental Cars') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ translate('Choose from our range of rental cars') }}
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">

                <form action="{{ route('customer.rentals.car.search') }}" method="GET"
                    class="bg-white p-6 rounded-xl shadow-md mb-8">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div class="md:col-span-3">
                            <input type="text" name="city" value="{{ request('city') }}" placeholder="{{ translate('Enter City') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-3 py-3 transition">
                            {{ translate('Search') }}
                        </button>

                    </div>

                </form>

                <!-- Card -->
                @foreach ($rentals as $rental)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                        <img src="{{ asset('storage/' . $rental->car->thumbnail) }}">

                        <div class="p-6">

                            <h3 class="text-2xl font-bold">
                                {{ translate($rental->car->title) }}
                            </h3>

                            <p class="text-gray-600 mt-3">
                                {{ translate($rental->car->transmission) . ' • ' . translate($rental->car->fuel_type) . ' • ' . translate($rental->car->mileage) }}
                            </p>

                            <div class="flex justify-between items-center mt-6">

                                <div>

                                    <p class="text-gray-500 text-sm">
                                        {{ translate('Starting from') }}
                                    </p>

                                    <p class="text-3xl font-bold text-yellow-500">
                                        ${{ translate($rental->price_per_day) }}{{translate('/day')}} 
                                    </p>

                                </div>

                                @if (Auth::check())
                                    <a href="{{ route('customer.single.rental.bookin.create', $rental->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                        {{ translate('Rent Now') }}
                                    </a>
                                @else
                                    <a href="/login"
                                        class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                        {{ translate('Rent Now') }}
                                    </a>
                                @endif


                            </div>

                        </div>

                    </div>
                @endforeach


            </div>

            <h2 class="text-3xl font-bold mb-6">{{ translate('P2P Rental Cars') }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach ($userCars as $car)
                    <div class="bg-white rounded-lg shadow">

                        <img src="{{ asset('storage/' . $car->main_image) }}"
                            class="w-full h-52 object-cover rounded-t-lg">

                        <div class="p-5">

                            <h3 class="text-xl font-bold">
                                {{ translate($car->brand) }} {{ translate($car->model) }}
                            </h3>

                            <p class="text-gray-600">
                                Owner: {{ translate($car->user->name) }}
                            </p>

                            <p class="font-semibold mt-2">
                                ${{ translate($car->price_per_day) }}/{{translate('/day')}}
                            </p>

                            @if (Auth::check())
                                <a href="{{ route('p2p.booking.create', $car->id) }}"
                                    class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                                    {{ translate('Rent Now') }}
                                </a>
                            @else
                                <a href="/login" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                                    {{ translate('Rent Now') }}
                                </a>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    @if ($recommendedRentals->count())

        <section class="mt-20 max-w-7xl mx-auto px-6">

            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold">
                    ⭐ {{ translate('Recommended Rental Cars') }}
                </h2>
                <p class="text-gray-500 mt-2">
                    {{ translate('Most popular rental cars for you') }}
                </p>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">

                @foreach ($recommendedRentals as $rental)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                        <div class="relative">

                            <img src="{{ asset('storage/' . $rental->car->thumbnail) }}"
                                alt="{{ translate($rental->car->title) }}" class="w-full h-56 object-cover">

                            <span
                                class="absolute top-3 left-3 bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                ⭐ {{ translate('Recommended') }}
                            </span>

                        </div>

                        <div class="p-6">

                            <h3 class="text-2xl font-bold">
                                {{ translate($rental->car->title) }}
                            </h3>

                            <p class="text-gray-600 mt-3">
                                {{ translate($rental->car->transmission) }}
                                •
                                {{ translate($rental->car->fuel_type) }}
                                •
                                {{ translate($rental->car->mileage) }}
                            </p>

                            <div class="flex justify-between items-center mt-6">

                                <div>
                                    <p class="text-gray-500 text-sm">
                                        {{ translate('Starting from') }}
                                    </p>

                                    <p class="text-3xl font-bold text-yellow-500">
                                        ${{ $rental->price_per_day }}{{ translate('/day') }}
                                    </p>
                                </div>

                                @auth
                                    <a href="{{ route('customer.single.rental.bookin.create', $rental->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                        {{ translate('Rent Now') }}
                                    </a>
                                @else
                                    <a href="{{ route('user.login') }}"
                                        class="bg-yellow-500 hover:bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
                                        {{ translate('Rent Now') }}
                                    </a>
                                @endauth

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>

    @endif

    <!-- ================= WHY CHOOSE ================= -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>

            <div>

                <h2 class="text-4xl font-bold">
                    {{ translate('Why Rent') }}
                </h2>

                <div class="space-y-6 mt-10">

                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Insured') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Insured Desc') }}
                        </p>

                    </div>


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Roadside') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Roadside Desc') }}
                        </p>

                    </div>


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Flexible Plans') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Flexible Plans Desc') }}
                        </p>

                    </div>


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('No Hidden Fees') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('No Hidden Fees Desc') }}
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
                {{ translate('How It Works') }}
            </h2>


            <div class="grid md:grid-cols-4 gap-8 mt-14">


                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        1

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ translate('Choose Vehicle') }}
                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        2

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ translate('Select Dates') }}
                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        3

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ translate('Confirm Booking') }}
                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-xl font-bold mx-auto">

                        4

                    </div>

                    <h4 class="font-semibold mt-5">
                        {{ translate('Pickup Drive') }}
                    </h4>

                </div>


            </div>

        </div>

    </section>

    @include('estimation_price.rental')
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
                        {{ translate('Leave Your Review') }}
                    </h2>

                    <p class="text-gray-500 mt-2">
                        {{ translate('We\'d love to hear about your experience.') }}
                    </p>

                </div>


                <form action="{{ route('customer.store.review') }}" method="POST" enctype="multipart/form-data"
                    class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label class="block mb-2 font-semibold">
                            {{ translate('Your Name') }}
                        </label>

                        <input type="text" name="name" value="{{ translate(Auth::user()->name) }}"
                            class="w-full border rounded-lg p-3" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            {{ translate('Location') }}
                        </label>

                        <input type="text" name="location" placeholder="Dhaka, Bangladesh"
                            class="w-full border rounded-lg p-3" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            {{ translate('Rating') }}
                        </label>

                        <select name="rating" class="w-full border rounded-lg p-3" required>

                            <option value="">{{
                                translate('Select Rating') }}</option>
                            <option value="5">⭐⭐⭐⭐⭐ {{ translate('Excellent') }}</option>
                            <option value="4">⭐⭐⭐⭐ {{ translate('Very Good') }}</option>
                            <option value="3">⭐⭐⭐ {{ translate('Good') }}</option>
                            <option value="2">⭐⭐ {{ translate('Fair') }}</option>
                            <option value="1">⭐ {{ translate('Poor') }}</option>

                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            {{ translate('Review') }}
                        </label>

                        <textarea name="review" rows="5" class="w-full border rounded-lg p-3" placeholder="Write your review..."
                            required></textarea>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            {{ translate('Image') }}
                        </label>

                        <input type="file" name="image" class="w-full border rounded-lg p-3">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                        {{ translate('Submit Review') }}
                    </button>

                </form>

            </div>
        </div>
    @endif

    <!-- ================= FAQ ================= -->
    <section class="bg-white py-20">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ translate('FAQ') }}
            </h2>


            <div class="space-y-6 mt-12">

                @foreach ($faqs as $faq)
                    <div class="bg-gray-100 rounded-lg p-6">

                        <h4 class="font-bold">
                            {{ translate($faq->question) }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate($faq->answer) }}
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
                {{ translate('Ready for Your Journey') }}
            </h2>


            <p class="mt-5 text-lg">
                {{ translate('Journey Desc') }}
            </p>


            @if (Auth::check())
                <a href="{{ route('customer.rental.booking.create') }}"
                    class="inline-block mt-8 bg-black text-white px-8 py-4 rounded-lg hover:bg-gray-800 transition">
                    {{ translate('Reserve Car') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-black text-white px-8 py-4 rounded-lg hover:bg-gray-800 transition">
                    {{ translate('Reserve Car') }}
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
