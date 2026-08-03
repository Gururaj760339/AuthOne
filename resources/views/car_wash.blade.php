<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Wash | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar', ['setting' => $setting])

    <!-- Hero Section -->
    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1607861716497-e65ab29fc7ac?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <span class="bg-blue-600 px-4 py-2 rounded-full text-sm">
                {{ translate('Messages Car Wash Badge') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ translate('Car Wash Title 1') }}
                <span class="text-blue-400">{{ translate('Car Wash Title 2') }}</span>
                {{ translate('Car Wash Title 3') }}
            </h1>

            <p class="text-gray-300 text-lg mt-6 max-w-2xl leading-8">
                {{ translate('Car Wash Description') }}
            </p>

            <div class="flex flex-wrap gap-4 mt-10">
                @if (Auth::check())
                    <a href="{{ route('customer.carwash.booking.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-semibold transition">
                        {{ translate('Book Now') }}
                    </a>
                @else
                    <a href="/login"
                        class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-semibold transition">
                        {{ translate('Book Now') }}
                    </a>
                @endif

                <a href="#packages"
                    class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                    {{ translate('View Packages') }}
                </a>
            </div>

        </div>

    </section>

    <!-- Packages -->

    <section id="packages" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">
                <h2 class="text-4xl font-bold">
                    {{ translate('Car Wash Packages') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ translate('Choose Package Text') }}
                </p>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8 mt-14 items-start">

                @foreach ($services as $service)
                    <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition duration-300">

                        <h3 class="text-2xl font-bold">
                            {{ translate($service->title) }}
                        </h3>

                        <p class="text-5xl font-bold text-blue-600 mt-6">
                            ${{ number_format($service->price) }}
                        </p>

                        <p class="text-gray-600 mt-6 leading-7">
                            {{ translate($service->description) }}
                        </p>

                        <a href="{{ route('customer.single.carwash', $service->slug) }}"
                            class="mt-8 block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition text-center">
                            {{ translate('Package Choose') }}
                        </a>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    @if ($recommendedServices->count())

        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">

                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold">
                        {{ translate('Recommended Car Wash Services') }}
                    </h2>
                    <p class="text-gray-600 mt-2">
                        {{ translate('Our most popular car wash packages') }}
                    </p>
                </div>

                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">

                    @foreach ($recommendedServices as $service)
                        <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition duration-300">

                            <span
                                class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                                {{ translate('⭐ Recommended') }}
                            </span>

                            <h3 class="text-2xl font-bold">
                                {{ translate($service->title) }}
                            </h3>

                            <p class="text-5xl font-bold text-blue-600 mt-6">
                                ${{ number_format($service->price) }}
                            </p>

                            <p class="text-gray-600 mt-6 leading-7">
                                {{ translate(Str::limit($service->description, 120)) }}
                            </p>

                            @if (isset($service->bookings_count))
                                <div class="mt-4 text-sm text-gray-500">
                                    {{ translate('Bookings') }}: {{ $service->bookings_count }}
                                </div>
                            @endif

                            <a href="{{ route('customer.single.carwash', $service->slug) }}"
                                class="mt-8 block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition text-center">
                                {{ translate('Package Choose') }}
                            </a>

                        </div>
                    @endforeach

                </div>

            </div>
        </section>

    @endif

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
                            💧 {{ translate('messages.Feature Title 1') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ translate('Messages Feature Desc 1') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl">
                            ✨ {{ translate('messages.Feature Title 2') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ translate('Messages Feature Desc 2') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl">
                            ⚡ {{ translate('messages.Feature Title 3') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ translate('Messages Feature Desc 3') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl">
                            🛡 {{ translate('messages.Feature Title 4') }}
                        </h4>
                        <p class="text-gray-600 mt-2">
                            {{ translate('Messages Feature Desc 4') }}
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
                {{ translate('messages How It Works') }}
            </h2>

            <div class="grid md:grid-cols-4 gap-8 mt-14 text-center">

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        1

                    </div>


                    <h4 class="mt-5 font-semibold">
                        {{ translate('Messages Step 1') }}
                    </h4>


                </div>

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        2

                    </div>


                    <h4 class="mt-5 font-semibold">
                        {{ translate('Messages Step 2') }}
                    </h4>

                </div>

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        3

                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ translate('Messages Step 3') }}
                    </h4>

                </div>

                <div>

                    <div
                        class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-xl font-bold">

                        4

                    </div>


                    <h4 class="mt-5 font-semibold">
                        {{ translate('Messages Step 4') }}
                    </h4>

                </div>

            </div>

        </div>

    </section>

    @if ($booking && $booking->status == 'Completed')
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

                        <textarea name="review" rows="5" class="w-full border rounded-lg p-3" placeholder="{{ translate('Write your review...') }}"
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

    <!-- Reviews -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ translate('Customer Reviews') }}
            </h2>

            <div class="grid md:grid-cols-3 gap-8 mt-14">

                @foreach ($testimonials as $testimonial)
                    <div class="bg-gray-100 rounded-xl p-8 rounded-lg shadow">

                        @if ($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}"
                                class="w-20 h-20 rounded-full object-cover mx-auto mb-4">
                        @endif

                        <div class="text-yellow-500 text-xl mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $testimonial->rating)
                                    ⭐
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>

                        <p class="text-gray-600">
                            {{ $testimonial->review }}
                        </p>

                        <h5 class="mt-5 font-bold text-lg">
                            {{ $testimonial->name }}
                        </h5>

                        <p class="text-gray-500 text-sm">
                            {{ $testimonial->location }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- FAQ -->

    <section class="py-20">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ translate('Frequently Asked Questions') }}
            </h2>

            <div class="space-y-6 mt-12">
                @foreach ($faqs as $faq)
                    <div class="bg-white shadow rounded-lg p-6">

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

    @include('ai_layer.chatbot')

    <!-- CTA -->

    <section class="bg-blue-600 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold">
                {{ translate('Ready to Get Clean?') }}
            </h2>

            <p class="mt-5 text-blue-100 text-lg">
                {{ translate('Book your car wash today and experience the difference!') }}
            </p>

            @if (Auth::check())
                <a href="{{ route('customer.carwash.booking.create') }}"
                    class="inline-block mt-8 bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
                    {{ translate('Book Car Wash') }}
                </a>
            @else
                <a href="/login"
                    class="inline-block mt-8 bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
                    {{ translate('Book Car Wash') }}
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
