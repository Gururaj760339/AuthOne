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
                {{ __('messages.worldwide_vehicle_import') }}
            </span>

            <h1 class="text-5xl font-bold mt-6">
                {{ __('messages.import_dream_car') }}
            </h1>

            <p class="text-gray-300 mt-6 max-w-2xl text-lg leading-8">
                {{ __('messages.import_description') }}
            </p>

            <div class="flex flex-wrap gap-4 mt-10">

                <a href="#inventory"
                    class="bg-indigo-600 hover:bg-indigo-700 px-8 py-4 rounded-lg font-semibold transition">
                    {{ __('messages.browse_imported_cars') }}
                </a>


                <a href="#process"
                    class="border border-white px-8 py-4 rounded-lg hover:bg-white hover:text-black transition">
                    {{ __('messages.import_process') }}
                </a>

            </div>

        </div>

    </section>

    <!-- Search -->

    <section class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="grid md:grid-cols-4 gap-4">

                <select class="border rounded-lg px-4 py-3">
                    <option>{{ __('messages.select_country') }}</option>
                    <option>Japan</option>
                    <option>Germany</option>
                    <option>South Korea</option>
                    <option>USA</option>
                </select>


                <select class="border rounded-lg px-4 py-3">
                    <option>{{ __('messages.select_brand') }}</option>
                    <option>Toyota</option>
                    <option>BMW</option>
                    <option>Mercedes-Benz</option>
                    <option>Hyundai</option>
                </select>


                <select class="border rounded-lg px-4 py-3">
                    <option>{{ __('messages.budget') }}</option>
                    <option>$10k - $20k</option>
                    <option>$20k - $40k</option>
                    <option>$40k+</option>
                </select>


                <button class="bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    {{ __('messages.search_vehicles') }}
                </button>

            </div>

        </div>

    </section>

    <!-- Featured Imports -->

    <section id="inventory" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">
                    {{ __('messages.featured_imported_cars') }}
                </h2>

                <p class="text-gray-600 mt-4">
                    {{ __('messages.premium_ready_delivery') }}
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-14">

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=900&q=80">

                    <div class="p-6">

                        <span class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            {{ __('messages.imported_from_japan') }}
                        </span>


                        <h3 class="text-2xl font-bold mt-4">
                            {{ __('messages.toyota_land_cruiser') }}
                        </h3>


                        <p class="text-gray-600 mt-3">
                            {{ __('messages.land_cruiser_details') }}
                        </p>



                        <div class="flex justify-between items-center mt-6">

                            <p class="text-2xl font-bold text-indigo-600">

                                $62,500

                            </p>

                            <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg">
                                {{ __('messages.view_details') }}
                            </button>

                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d?auto=format&fit=crop&w=900&q=80">

                    <div class="p-6">

                        <span class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                            {{ __('messages.imported_from_germany') }}
                        </span>


                        <h3 class="text-2xl font-bold mt-4">
                            {{ __('messages.bmw_x5') }}
                        </h3>


                        <p class="text-gray-600 mt-3">
                            {{ __('messages.bmw_details') }}
                        </p>
                        <div class="flex justify-between items-center mt-6">

                            <p class="text-2xl font-bold text-indigo-600">

                                $71,900

                            </p>

                            <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg">
                                {{ __('messages.view_details') }}
                            </button>

                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80">

                    <div class="p-6">

                        <span class="text-sm bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                            {{ __('messages.imported_from_korea') }}
                        </span>


                        <h3 class="text-2xl font-bold mt-4">
                            {{ __('messages.hyundai_palisade') }}
                        </h3>


                        <p class="text-gray-600 mt-3">
                            {{ __('messages.palisade_details') }}
                        </p>

                        <div class="flex justify-between items-center mt-6">

                            <p class="text-2xl font-bold text-indigo-600">

                                $49,900

                            </p>

                            <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg">
                                {{ __('messages.view_details') }}
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Why Choose -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>


            <div>

                <h2 class="text-4xl font-bold">
                    {{ __('messages.why_import') }}
                </h2>


                <div class="space-y-6 mt-10">


                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.global_network') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.global_network_desc') }}
                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.complete_documentation') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.complete_documentation_desc') }}
                        </p>

                    </div>



                    <div>

                        <h4 class="font-bold text-xl">
                            ✔ {{ __('messages.secure_shipping') }}
                        </h4>

                        <p class="text-gray-600 mt-2">
                            {{ __('messages.secure_shipping_desc') }}
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


                </div>

            </div>

        </div>

    </section>
    <!-- Process -->

    <section id="process" class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">
                {{ __('messages.import_process') }}
            </h2>


            <div class="grid md:grid-cols-5 gap-8 mt-14 text-center">


                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        1
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.choose_vehicle') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        2
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.request_quote') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        3
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.documentation') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        4
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.shipping') }}
                    </h4>

                </div>



                <div>

                    <div
                        class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center mx-auto font-bold">
                        5
                    </div>

                    <h4 class="mt-5 font-semibold">
                        {{ __('messages.delivery') }}
                    </h4>

                </div>


            </div>

        </div>

    </section>

    <!-- CTA -->

    <section class="bg-indigo-600 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold">
                {{ __('messages.ready_import_vehicle') }}
            </h2>


            <p class="mt-5 text-lg text-indigo-100">
                {{ __('messages.cta_import_desc') }}
            </p>

            @if (Auth::check())
                <a href="" class="inline-block mt-8 bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold">
                    {{ __('messages.request_import_quote') }}
                </a>
            @else
                <a href="/login" class="inline-block mt-8 bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold">
                    {{ __('messages.request_import_quote') }}
                </a>
            @endif


        </div>

    </section>

</body>

</html>
