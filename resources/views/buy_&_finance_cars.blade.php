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
                {{ __('messages.buy_dream_car') }}
            </span>

            <h1 class="text-5xl font-bold mt-6 leading-tight">

                {{ __('messages.buy_finance_cars') }}

            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg">
                {{ __('messages.browse_quality_cars') }}
            </p>


            <div class="mt-10 flex gap-4 flex-wrap">

                <a href="#cars" class="bg-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-green-700 transition">
                    {{ __('messages.browse_cars') }}
                </a>

                <a href="#finance"
                    class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">

                    {{ __('messages.finance_options') }}

                </a>

            </div>

        </div>

    </section>

    <section id="cars" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">

                    {{ __('messages.featured_vehicles') }}

                </h2>


                <p class="text-gray-600 mt-4">

                    {{ __('messages.popular_cars') }}

                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">
                @foreach ($cars as $car)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="storage/{{$car->thumbnail}}">

                    <div class="p-6">

                        <h3 class="text-xl font-bold">

                            {{ $car->title }}

                        </h3>

                        <p class="text-gray-600 mt-2">

                            {{ $car->transmission . ' • ' . $car->fuel_type . ' • ' . $car->mileage }}

                        </p>

                        <div class="flex justify-between items-center mt-6">

                            <span class="text-2xl font-bold text-green-600">

                                ${{ $car->price }}

                            </span>

                            <a href="{{ route('vehicle.details', $car->slug)}} " class="bg-green-600 text-white px-5 py-2 rounded">

                                {{ __('messages.view') }}

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

                    {{ __('messages.flexible_finance_plans') }}

                </h2>


                <div class="space-y-6 mt-8">


                    <div>

                        <h4 class="font-bold text-xl">

                            {{ __('messages.low_down_payment') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ __('messages.low_down_payment_desc') }}

                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">

                            {{ __('messages.fast_approval') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ __('messages.fast_approval_desc') }}

                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">

                            {{ __('messages.flexible_terms') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ __('messages.flexible_terms_desc') }}

                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">

                            {{ __('messages.competitive_rates') }}

                        </h4>


                        <p class="text-gray-600 mt-2">

                            {{ __('messages.competitive_rates_desc') }}

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

                {{ __('messages.finance_process') }}

            </h2>


            <div class="grid md:grid-cols-4 gap-8 mt-14">


                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        1

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ __('messages.choose_car') }}

                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        2

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ __('messages.apply_finance') }}

                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        3

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ __('messages.document_review') }}

                    </h4>

                </div>



                <div class="text-center">

                    <div
                        class="bg-green-600 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-white font-bold">

                        4

                    </div>

                    <h4 class="font-semibold mt-5">

                        {{ __('messages.drive_away') }}

                    </h4>

                </div>


            </div>

        </div>

    </section>

    @if ($finance && $finance->status == 'Approved')
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

    <!-- CTA -->

    <section class="bg-green-600 py-20 text-center text-white">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold">

                {{ __('messages.ready_next_car') }}

            </h2>


            <p class="mt-5 text-lg text-green-100">

                {{ __('messages.ready_next_car_desc') }}

            </p>

            @if (Auth::check())
                <a href="{{ route('customer.finance.apply') }}"
                    class="inline-block mt-8 bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100">
                    {{ __('messages.apply_for_finance') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100">
                    {{ __('messages.apply_for_finance') }}
                </a>
            @endif


        </div>

    </section>

</body>

</html>
