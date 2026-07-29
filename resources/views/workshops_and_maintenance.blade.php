<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshops & Maintenance | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body class="bg-gray-50">
    @include('navbar', ['setting' => $setting])

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
                    <a href="{{ route('customer.maintenance.booking.create') }}"
                        class="bg-red-600 hover:bg-red-700 px-7 py-4 rounded-lg font-semibold transition">
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
                @foreach ($services as $service)
                    <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">

                        <div class="text-5xl mb-5">
                            <i class="{{ $service->serviceCategory->icon }}"></i>
                        </div>

                        <h3 class="font-bold text-xl">
                            {{ $service->title }}
                        </h3>

                        <p class="mt-3 text-gray-600">
                            {{ $service->description }}
                        </p>

                    </div>
                @endforeach
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

    @include('ai_layer.chatbot')

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

    

    <!-- Reviews -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-center text-4xl font-bold">
                {{ __('messages.customer_reviews') }}
            </h2>

            <div class="grid md:grid-cols-3 gap-8 mt-14">

    @foreach($testimonials as $testimonial)

    <div class="bg-gray-100 rounded-xl p-8 rounded-lg shadow">

        @if($testimonial->image)
            <img src="{{ asset('storage/'.$testimonial->image) }}"
                class="w-20 h-20 rounded-full object-cover mx-auto mb-4">
        @endif

        <div class="text-yellow-500 text-xl mb-3">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $testimonial->rating)
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
                {{ __('messages.faq') }}
            </h2>

            <div class="space-y-6 mt-12">
                @foreach ($faqs as $faq)
                <div class="bg-white rounded-lg shadow p-6">

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
                <a href="{{ route('customer.maintenance.booking.create') }}"
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

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
