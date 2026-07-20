<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar')
    <!-- ================= HERO ================= -->

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28 text-center">

            <span class="bg-red-600 px-4 py-2 rounded-full text-sm">
                {{ __('messages.get_in_touch') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ __('messages.contact_autoone') }}
            </h1>

            <p class="text-gray-300 mt-6 max-w-3xl mx-auto text-lg leading-8">
                {{ __('messages.contact_description') }}
            </p>

        </div>

    </section>

    <!-- ================= CONTACT ================= -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-3 gap-10">


                <!-- Contact Info -->

                <div class="space-y-6">


                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="text-4xl">📍</div>

                        <h3 class="text-xl font-bold mt-4">
                            {{ __('messages.head_office') }}
                        </h3>

                        <p class="text-gray-600 mt-2">
                           {{ $setting->address }}
                        </p>

                    </div>



                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="text-4xl">📞</div>

                        <h3 class="text-xl font-bold mt-4">
                            {{ __('messages.phone') }}
                        </h3>

                        <p class="text-gray-600 mt-2">
                            {{ $setting->phone }}
                        </p>

                    </div>



                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="text-4xl">✉️</div>

                        <h3 class="text-xl font-bold mt-4">
                            {{ __('messages.email') }}
                        </h3>

                        <p class="text-gray-600 mt-2">
                            {{ $setting->email }}
                        </p>

                    </div>


                </div>



                <!-- Contact Form -->

                <div class="lg:col-span-2 bg-white rounded-xl shadow p-8">


                    <h2 class="text-3xl font-bold">
                        {{ __('messages.send_message') }}
                    </h2>


                    <p class="text-gray-600 mt-3">
                        {{ __('messages.message_description') }}
                    </p>



                    @if (session('success'))
                        <div class="mb-4 bg-green-100 text-green-700 p-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('customer.contact.store') }}" method="POST" class="mt-8 space-y-6">

                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">

                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="{{ __('messages.full_name') }}"
                                class="border rounded-lg px-4 py-3 w-full">

                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="{{ __('messages.email_address') }}"
                                class="border rounded-lg px-4 py-3 w-full">

                        </div>

                        <div class="grid md:grid-cols-2 gap-6">

                            <input type="text" name="phone" value="{{ old('phone') }}"
                                placeholder="{{ __('messages.phone_number') }}"
                                class="border rounded-lg px-4 py-3 w-full">

                            <select name="subject" class="border rounded-lg px-4 py-3 w-full">

                                <option value="">Select Inquiry</option>
                                <option value="Buy Car">Buy Car</option>
                                <option value="Finance">Finance</option>
                                <option value="Car Rental">Car Rental</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Car Wash">Car Wash</option>
                                <option value="Car Imports">Car Imports</option>
                                <option value="General Question">General Question</option>

                            </select>

                        </div>

                        <textarea name="message" rows="6" placeholder="{{ __('messages.write_message') }}"
                            class="border rounded-lg px-4 py-3 w-full">{{ old('message') }}</textarea>

                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg font-semibold">

                            {{ __('messages.send') }}

                        </button>

                    </form>


                </div>


            </div>

        </div>

    </section>

    <!-- ================= BUSINESS HOURS ================= -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-10">


                <div>

                    <h2 class="text-4xl font-bold">
                        {{ __('messages.business_hours') }}
                    </h2>


                    <div class="mt-8 space-y-4">


                        <div class="flex justify-between border-b pb-3">

                            <span>
                                {{ __('messages.monday_friday') }}
                            </span>

                            <span>
                                09:00 AM - 06:00 PM
                            </span>

                        </div>



                        <div class="flex justify-between border-b pb-3">

                            <span>
                                {{ __('messages.saturday') }}
                            </span>

                            <span>
                                10:00 AM - 04:00 PM
                            </span>

                        </div>



                        <div class="flex justify-between">

                            <span>
                                {{ __('messages.sunday') }}
                            </span>

                            <span class="text-red-600 font-semibold">
                                {{ __('messages.closed') }}
                            </span>

                        </div>


                    </div>

                </div>



                <div>

                    <h2 class="text-4xl font-bold">
                        {{ __('messages.regional_offices') }}
                    </h2>


                    <div class="mt-8 space-y-4">


                        <div class="bg-gray-100 rounded-lg p-4">
                            📍 {{ __('messages.dubai_uae') }}
                        </div>


                        <div class="bg-gray-100 rounded-lg p-4">
                            📍 {{ __('messages.riyadh_saudi') }}
                        </div>


                        <div class="bg-gray-100 rounded-lg p-4">
                            📍 {{ __('messages.doha_qatar') }}
                        </div>


                        <div class="bg-gray-100 rounded-lg p-4">
                            📍 {{ __('messages.kuwait_city') }}
                        </div>


                    </div>

                </div>


            </div>

        </div>

    </section>

    <!-- ================= MAP ================= -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.find_office') }}
            </h2>


            <div>
                {{ __('messages.google_map') }}
            </div>

        </div>

    </section>

    <!-- ================= QUICK LINKS ================= -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.quick_help') }}
            </h2>


            <div class="grid md:grid-cols-3 gap-8 mt-14">


                <div class="bg-gray-50 rounded-xl p-8 text-center">

                    <h3 class="font-bold text-xl">
                        {{ __('messages.faq') }}
                    </h3>

                    <p class="text-gray-600 mt-4">
                        {{ __('messages.faq_desc') }}
                    </p>

                    <a href="#" class="text-red-600 font-semibold mt-6 inline-block">
                        {{ __('messages.view_faq') }} →
                    </a>

                </div>



                <div class="bg-gray-50 rounded-xl p-8 text-center">

                    <h3 class="font-bold text-xl">
                        {{ __('messages.book_service') }}
                    </h3>

                    <p class="text-gray-600 mt-4">
                        {{ __('messages.service_desc') }}
                    </p>

                    <a href="#" class="text-red-600 font-semibold mt-6 inline-block">
                        {{ __('messages.book_now') }} →
                    </a>

                </div>



                <div class="bg-gray-50 rounded-xl p-8 text-center">

                    <h3 class="font-bold text-xl">
                        {{ __('messages.support_center') }}
                    </h3>

                    <p class="text-gray-600 mt-4">
                        {{ __('messages.support_desc') }}
                    </p>

                    <a href="#" class="text-red-600 font-semibold mt-6 inline-block">
                        {{ __('messages.get_support') }} →
                    </a>

                </div>


            </div>

        </div>

    </section>

    <!-- ================= CTA ================= -->

    <section class="bg-red-600 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold">
                {{ __('messages.ready_help') }}
            </h2>


            <p class="mt-6 text-red-100 text-lg">
                {{ __('messages.help_description') }}
            </p>


            <a href="#" class="inline-block mt-8 bg-white text-red-600 px-8 py-4 rounded-lg font-semibold">
                {{ __('messages.contact_team') }}
            </a>

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