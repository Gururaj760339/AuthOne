<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Imports | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar')

    <!-- Hero Section -->

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <span class="bg-indigo-600 px-4 py-2 rounded-full text-sm">
                {{ translate('Worldwide Vehicle Import') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ translate('Import Your Dream Car') }}
            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg leading-8">
                {{ translate('Import Your Dream Car Desc') }}
            </p>

            <div class="flex flex-wrap gap-4 mt-10">

                <a href="#inventory"
                    class="bg-indigo-600 hover:bg-indigo-700 px-8 py-4 rounded-lg font-semibold transition">
                    {{ translate('Browse Imported Cars') }}
                </a>


                <a href="#process"
                    class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                    {{ translate('Import Process') }}
                </a>

            </div>

        </div>

    </section>

    <!-- Featured Imports -->

    <section id="inventory" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">
                    {{ translate('Featured Imported Cars') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ translate('Premium Ready for Delivery') }}
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">
                @foreach ($requests as $request)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <img
                            src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80">

                        <div class="p-6">
                            <span class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                {{ translate('Imported from') }} {{ $request->country }}
                            </span>


                            <h3 class="text-2xl font-bold mt-4">
                                {{ translate('Car Name') }}: {{ translate($request->car_name) }}
                            </h3>

                            <div class="flex justify-between items-center mt-6">

                                <p class="text-2xl font-bold text-indigo-600">

                                    ${{ $request->budget }}

                                </p>

                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

        </div>

        </div>

    </section>

    @if ($recommendedImports->count())

        <section class="py-20 bg-gray-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center">

                    <h2 class="text-4xl font-bold">
                        ⭐ {{ translate('Recommended Import Cars') }}
                    </h2>

                    <p class="text-gray-600 mt-4">
                        {{ translate('Best completed import requests for you') }}
                    </p>

                </div>

                <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 mt-14">

                    @foreach ($recommendedImports as $request)
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                            <div class="relative">

                                <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80"
                                    class="w-full h-56 object-cover" alt="{{ $request->car_name }}">

                                <span
                                    class="absolute top-3 left-3 bg-yellow-500 text-white text-xs px-3 py-1 rounded-full">
                                    ⭐ {{ translate('Recommended') }}
                                </span>

                            </div>

                            <div class="p-6">

                                <span class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    {{ translate('Imported from') }} {{ $request->country }}
                                </span>

                                <h3 class="text-xl font-bold mt-4">
                                    {{ translate('Car Name') }}: {{ $request->car_name }}
                                </h3>

                                <p class="text-gray-500 mt-3">
                                    {{ translate('Budget') }}
                                </p>

                                <p class="text-2xl font-bold text-indigo-600 mt-1">
                                    ${{ number_format($request->budget) }}
                                </p>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </section>

    @endif

    <!-- Why Choose -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>


            <div>

                <h2 class="text-4xl font-bold">
                    {{ translate('Why Import') }}
                </h2>


                <div class="space-y-6 mt-10">


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Global Network') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Global Network Description') }}
                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Complete Documentation') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Complete Documentation Description') }}
                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Secure Shipping') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Secure Shipping Description') }}
                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ translate('Transparent Pricing') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ translate('Transparent Pricing Description') }}
                        </p>

                    </div>


                </div>

            </div>

        </div>

    </section>
    <!-- Process -->

    <section id="process" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ translate('Import Process') }}
            </h2>


            <div class="grid md:grid-cols-5 gap-8 mt-14 text-center">


                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        1
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ translate('Choose Vehicle') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        2
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ translate('Request Quote') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        3
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ translate('Documentation') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        4
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ translate('Shipping') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        5
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ translate('Delivery') }}
                    </h4>

                </div>


            </div>

        </div>

    </section>

    @include('estimation_price.import')
    @include('ai_layer.chatbot')

    @if (Auth::check() && $import_requests && $import_requests->status == 'Completed')
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

                            <option value="">{{ translate('Select Rating') }}</option>
                            <option value="5">{{ translate('⭐⭐⭐⭐⭐ Excellent') }}</option>
                            <option value="4">{{ translate('⭐⭐⭐⭐ Very Good') }}</option>
                            <option value="3">{{ translate('⭐⭐⭐ Good') }}</option>
                            <option value="2">{{ translate('⭐⭐ Fair') }}</option>
                            <option value="1">{{ translate('⭐ Poor') }}</option>

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

    <section class="bg-indigo-600 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold">
                {{ translate('Ready to Import a Vehicle?') }}
            </h2>


            <p class="mt-5 text-lg text-indigo-100">
                {{ translate('Cta Import Description') }}
            </p>

            @if (Auth::check())
                <a href="{{ route('customer.import.request.create') }}"
                    class="inline-block mt-8 bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold">
                    {{ translate('Request Import Quote') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold">
                    {{ translate('Request Import Quote') }}
                </a>
            @endif


        </div>

    </section>

</body>

</html>
