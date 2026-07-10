<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    @include('navbar')

    <!-- ================= HERO ================= -->

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1489824904134-891ab64532f1?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28">

            <span class="bg-red-600 px-4 py-2 rounded-full text-sm">
                About AutoOne
            </span>

            <h1 class="text-5xl font-bold mt-6">
                Driving the Future of
                <span class="text-red-500">Automotive Services</span>
            </h1>

            <p class="text-gray-300 mt-6 max-w-3xl text-lg leading-8">
                AutoOne is a trusted automotive platform serving customers across the
                Middle East with vehicle sales, financing, rentals, imports,
                workshops, and professional car care services.
            </p>

        </div>

    </section>

    <!-- ================= OUR STORY ================= -->

    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

            <div>

                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=900&q=80"
                    class="rounded-xl shadow-xl">

            </div>

            <div>

                <h2 class="text-4xl font-bold">

                    Our Story

                </h2>

                <p class="text-gray-600 mt-6 leading-8">

                    AutoOne was established to simplify the automotive experience by bringing
                    vehicle buying, financing, maintenance, rentals, imports, and after-sales
                    services into one trusted platform.

                </p>

                <p class="text-gray-600 mt-4 leading-8">

                    Today we work with certified workshops, financial institutions,
                    international suppliers, and automotive experts to provide customers
                    with transparent, reliable, and professional services.

                </p>

            </div>

        </div>

    </section>

    <!-- ================= MISSION & VISION ================= -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8">

            <div class="bg-white p-10 rounded-xl shadow">

                <div class="text-5xl">🎯</div>

                <h3 class="text-2xl font-bold mt-6">

                    Our Mission

                </h3>

                <p class="text-gray-600 mt-4 leading-8">

                    To provide customers with an easy, transparent, and reliable automotive
                    experience through innovative digital solutions and exceptional service.

                </p>

            </div>

            <div class="bg-white p-10 rounded-xl shadow">

                <div class="text-5xl">🚀</div>

                <h3 class="text-2xl font-bold mt-6">

                    Our Vision

                </h3>

                <p class="text-gray-600 mt-4 leading-8">

                    To become the leading multilingual automotive platform in the Middle East,
                    connecting people with trusted automotive solutions.

                </p>

            </div>

        </div>

    </section>

    <!-- ================= WHY CHOOSE ================= -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">

                    Why Choose AutoOne?

                </h2>

                <p class="text-gray-600 mt-4">

                    Trusted by thousands of drivers and automotive partners.

                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-14">

                <div class="text-center p-8 rounded-xl bg-gray-50">

                    <div class="text-5xl">✔</div>

                    <h4 class="font-bold mt-5">

                        Certified Partners

                    </h4>

                </div>

                <div class="text-center p-8 rounded-xl bg-gray-50">

                    <div class="text-5xl">🌍</div>

                    <h4 class="font-bold mt-5">

                        Global Vehicle Network

                    </h4>

                </div>

                <div class="text-center p-8 rounded-xl bg-gray-50">

                    <div class="text-5xl">🛡</div>

                    <h4 class="font-bold mt-5">

                        Secure Transactions

                    </h4>

                </div>

                <div class="text-center p-8 rounded-xl bg-gray-50">

                    <div class="text-5xl">⭐</div>

                    <h4 class="font-bold mt-5">

                        Excellent Customer Support

                    </h4>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= STATS ================= -->

    <section class="py-20 bg-red-600 text-white">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">

                <div>
                    <h3 class="text-5xl font-bold">25K+</h3>
                    <p class="mt-3">Happy Customers</p>
                </div>

                <div>
                    <h3 class="text-5xl font-bold">2,000+</h3>
                    <p class="mt-3">Cars Sold</p>
                </div>

                <div>
                    <h3 class="text-5xl font-bold">150+</h3>
                    <p class="mt-3">Workshop Partners</p>
                </div>

                <div>
                    <h3 class="text-5xl font-bold">12</h3>
                    <p class="mt-3">Countries Served</p>
                </div>

            </div>

        </div>

    </section>

    <!-- ================= SERVICES ================= -->

    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">

                    Our Services

                </h2>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-14">

                <div class="bg-gray-50 p-8 rounded-xl shadow">
                    <h4 class="font-bold text-xl">🚗 Buy & Finance Cars</h4>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow">
                    <h4 class="font-bold text-xl">🔧 Workshops & Maintenance</h4>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow">
                    <h4 class="font-bold text-xl">💦 Car Wash</h4>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow">
                    <h4 class="font-bold text-xl">🚙 Car Rental</h4>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow">
                    <h4 class="font-bold text-xl">🚢 Car Imports</h4>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow">
                    <h4 class="font-bold text-xl">💳 Vehicle Financing</h4>
                </div>

            </div>

        </div>

    </section>

    <!-- ================= TEAM ================= -->

    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center">

                <h2 class="text-4xl font-bold">

                    Leadership Team

                </h2>

                <p class="text-gray-600 mt-4">

                    Experienced professionals driving innovation.

                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-8 mt-14">

                <div class="bg-white rounded-xl shadow overflow-hidden">

                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-full">

                    <div class="p-6 text-center">

                        <h3 class="font-bold text-xl">

                            Ahmed Al Mansoori

                        </h3>

                        <p class="text-gray-500">

                            Chief Executive Officer

                        </p>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow overflow-hidden">

                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-full">

                    <div class="p-6 text-center">

                        <h3 class="font-bold text-xl">

                            Sarah Johnson

                        </h3>

                        <p class="text-gray-500">

                            Operations Director

                        </p>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow overflow-hidden">

                    <img src="https://randomuser.me/api/portraits/men/51.jpg" class="w-full">

                    <div class="p-6 text-center">

                        <h3 class="font-bold text-xl">

                            Mohammed Khalid

                        </h3>

                        <p class="text-gray-500">

                            Head of Customer Success

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= CTA ================= -->

    <section class="bg-slate-900 text-white py-20">

        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-4xl font-bold">

                Let's Drive Forward Together

            </h2>

            <p class="mt-6 text-gray-300 text-lg">

                Whether you're buying a car, importing one, booking a rental, or maintaining your vehicle, AutoOne is
                here to make every step simple and reliable.

            </p>

            <a href="#"
                class="inline-block mt-8 bg-red-600 hover:bg-red-700 px-8 py-4 rounded-lg font-semibold transition">

                Contact Us

            </a>

        </div>

    </section>

</body>

</html>
