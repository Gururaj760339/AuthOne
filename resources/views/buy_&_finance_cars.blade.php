<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buy & Finance Cars | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50">
    @include('navbar', ['setting' => $setting])

    <!-- Hero -->

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <!-- Hero -->

            <span class="bg-green-600 px-4 py-2 rounded-full text-sm">
                {{ translate('Messages Buy Dream Car') }}
            </span>

            <h1 class="text-5xl font-bold mt-6 leading-tight">

                {{ translate('Buy & Finance Cars') }}

            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg">
                {{ translate('Browse our selection of quality cars for sale and financing options.') }}
            </p>


            <div class="mt-10 flex gap-4 flex-wrap">

                <a href="#cars" class="bg-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-green-700 transition">
                    {{ translate('Browse Cars') }}
                </a>

                <a href="#finance"
                    class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">

                    {{ translate('Finance Options') }}

                </a>

            </div>

        </div>

    </section>

    {{-- Filter Section --}}

    <div class="container mx-auto py-10">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Filter -->
            <div class="bg-white shadow rounded-lg p-5 h-fit">

                <h2 class="text-xl font-bold mb-5">
                    {{ translate('Filter Cars') }}
                </h2>

                <form action="{{ route('cars.filter') }}" method="GET">

                    <!-- Brand -->
                    <div class="mb-4">
                        <label class="font-semibold">
                            {{ translate('Brand') }}
                        </label>

                        <select name="brand" class="w-full mt-2 border rounded-lg p-2">

                            <option value="">{{ translate('All Brands') }}</option>

                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(request('brand') == $brand->id)>
                                    {{ translate($brand->name) }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Fuel -->

                    <div class="mb-4">

                        <label class="font-semibold">
                            {{ translate('Fuel Type') }}
                        </label>

                        <select name="fuel_type" class="w-full mt-2 border rounded-lg p-2">

                            <option value="">{{ translate('All') }}</option>

                            <option value="Petrol">{{ translate('Petrol') }}</option>

                            <option value="Diesel">{{ translate('Diesel') }}</option>

                            <option value="Hybrid">{{ translate('Hybrid') }}</option>

                            <option value="Electric">{{ translate('Electric') }}</option>

                        </select>

                    </div>

                    <!-- Condition -->

                    <div class="mb-4">

                        <label class="font-semibold">
                            {{ translate('Condition') }}
                        </label>

                        <select name="condition" class="w-full mt-2 border rounded-lg p-2">

                            <option value="">{{ translate('All') }} </option>

                            <option value="New">{{ translate('New') }}</option>

                            <option value="Used">{{ translate('Used') }}</option>

                        </select>

                    </div>

                    <!-- Price -->

                    <div class="mb-4">

                        <label class="font-semibold">
                            {{ translate('Min Price') }}
                        </label>

                        <input type="number" name="min_price" value="{{ request('min_price') }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <div class="mb-4">

                        <label class="font-semibold">
                            {{ translate('Max Price') }}
                        </label>

                        <input type="number" name="max_price" value="{{ request('max_price') }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <!-- Year -->

                    <div class="mb-5">

                        <label class="font-semibold">
                            {{ translate('Year') }}
                        </label>

                        <input type="number" name="year" value="{{ request('year') }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">

                        {{ translate('Search') }}

                    </button>

                </form>

            </div>

            <!-- Cars -->

            <div class="lg:col-span-3">

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($cars as $car)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                            <img src="storage/{{ $car->thumbnail }}">

                            <div class="p-6">

                                <h3 class="text-xl font-bold">

                                    {{ translate($car->title) }}

                                </h3>

                                <p class="text-gray-600 mt-2">

                                    {{ translate($car->transmission) . ' • ' . translate($car->fuel_type) . ' • ' . translate($car->mileage) }}

                                </p>

                                <div class="flex justify-between items-center mt-6">

                                    <span class="text-2xl font-bold text-green-600">

                                        ${{ translate($car->price) }}

                                    </span>

                                    <a href="{{ route('vehicle.details', $car->slug) }} "
                                        class="bg-green-600 text-white px-5 py-2 rounded">

                                        {{ translate('View Details') }}

                                    </a>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-span-3 text-center py-10">

                            {{ translate('No Cars Found') }}    

                        </div>
                    @endforelse

                </div>

                <div class="mt-8">

                    {{ $cars->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

    @if ($recommendedCars->count())

        <section class="mt-20 ml-20 mr-6">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    ⭐ {{ translate('Recommended Cars') }}
                </h2>
                <p class="text-gray-500 mt-2">
                    {{ translate('Best cars selected for you') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($recommendedCars as $car)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                        <div class="relative">
                            <img src="{{ asset('storage/' . $car->thumbnail) }}" alt="{{ $car->title }}"
                                class="w-full h-40 object-cover">

                            <span
                                class="absolute top-2 left-2 bg-yellow-400 text-black text-xs font-semibold px-2 py-1 rounded">
                                ⭐ {{ translate('Recommended') }}
                            </span>
                        </div>

                        <div class="p-4">

                            <h3 class="font-semibold text-lg truncate">
                                {{ translate($car->title) }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-2">
                                {{ translate($car->transmission) }} •
                                {{ translate($car->fuel_type) }}
                            </p>

                            <p class="text-lg font-bold text-green-600 mt-3">
                                ${{ number_format(translate($car->price)) }}
                            </p>

                            <a href="{{ route('vehicle.details', $car->slug) }}"
                                class="block mt-4 text-center bg-green-600 hover:bg-green-700 text-white py-2 rounded-md text-sm">
                                {{ translate('View Details') }}
                            </a>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>

    @endif

    <section id="cars" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">

                    {{ translate('Featured Vehicles') }}

                </h2>


                <p class="text-gray-600 mt-4">

                    {{ translate('Popular Cars') }}

                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">
                @foreach ($featuredCars as $car)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                        <img src="storage/{{ $car->thumbnail }}">

                        <div class="p-6">

                            <h3 class="text-xl font-bold">

                                {{ translate($car->title) }}

                            </h3>

                            <p class="text-gray-600 mt-2">

                                {{ translate($car->transmission) . ' • ' . translate($car->fuel_type) . ' • ' . translate($car->mileage) }}

                            </p>

                            <div class="flex justify-between items-center mt-6">

                                <span class="text-2xl font-bold text-green-600">

                                    ${{ number_format(translate($car->price)) }}

                                </span>

                                <a href="{{ route('vehicle.details', $car->slug) }} "
                                    class="bg-green-600 text-white px-5 py-2 rounded">

                                    {{ translate('View Details') }}

                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- Finance -->

    <section id="finance" class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>


            <div>

                <h2 class="text-4xl font-bold">

                    {{ translate('Flexible Finance Plans') }}

                </h2>


                <div class="space-y-6 mt-8">


                    <div>

                        <h4 class="font-bold text-xl">

                            {{ translate('Low Down Payment') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ translate('low_down_payment_desc') }}

                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">

                            {{ translate('Fast Approval') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ translate('Fast Approval Desc') }}

                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">

                            {{ translate('Flexible Terms') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ translate('flexible_terms_desc') }}

                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">

                            {{ translate('Competitive Rates') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ translate('Competitive Rates Description') }}

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

                {{ translate('Finance Process') }}

            </h2>


            <div class="grid md:grid-cols-4 gap-8 mt-14">


                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        1

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ translate('Choose Car') }}

                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        2

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ translate('Apply for Finance') }}

                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        3

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ translate('Document Review') }}

                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        4

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ translate('Drive Away') }}

                    </h4>

                </div>


            </div>

        </div>

    </section>

    @include('finance.finance-chat')

    @include('ai_layer.chatbot')

    @if (Auth::check() && $finance && $finance->status == 'Approved')
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

                        <input type="text" name="name" value="{{ Auth::user()->name }}"
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

                            <option value="">{{ translate('Select Rating') }} </option>
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

    <!-- CTA -->

    <section class="bg-green-600 py-20 text-center text-white">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold">

                {{ translate('Ready for Your Next Car') }}

            </h2>


            <p class="mt-5 text-lg text-green-100">

                {{ translate('Ready for Your Next Car Desc') }}

            </p>

            @if (Auth::check())
                <a href="{{ route('customer.finance.apply') }}"
                    class="inline-block mt-8 bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100">
                    {{ translate('Apply for Finance') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100">
                    {{ translate('Apply for Finance') }}
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
