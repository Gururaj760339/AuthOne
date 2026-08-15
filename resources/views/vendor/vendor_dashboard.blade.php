<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-72 bg-gray-900 text-white">

            <div class="p-6 border-b border-gray-700">

                <h2 class="text-3xl font-bold text-red-500">
                    🚗 AutoOne
                </h2>

                <p class="text-gray-400 mt-2">
                    Vendor Panel
                </p>

            </div>

            <nav class="mt-5">

                <a href="#" class="flex items-center gap-3 px-6 py-4 bg-red-600 hover:bg-red-700">

                    <i class="fa-solid fa-house"></i>

                    Dashboard

                </a>

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-user"></i>

                    Profile

                </a>

                <a href="{{ route('vendor.service') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-gears"></i>

                    Service

                </a>


                <a href="{{ route('vendor.cars') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-car"></i>

                    My Cars

                </a>

                <a href="{{ route('vendor.rental') }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-key"></i>

                    RentCar

                </a>

                {{-- <a href="{{ route('vendor.finance.request') }}"
               class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                <i class="fa-solid fa-key"></i>

                Finance Request

            </a> --}}

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-ship"></i>

                    Import Car

                </a>

                <li x-data="{ open: false }">
                    <!-- Parent Menu -->
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-gears"></i>
                            <span>Spare Parts</span>
                        </span>

                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" x-transition class="mt-2 ml-6 space-y-1">
                        <a href="{{ route('vendor.spare-parts.index') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                            All SpareParts
                        </a>

                        <a href="{{ route('vendor.spare.images') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                            All SpareParts Images
                        </a>

                        <a href="{{ route('vendor.spare-parts.orders') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                            Orders
                        </a>

                    </div>
                </li>

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-calendar-check"></i>

                    Bookings

                </a>

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-car"></i>

                    Cars

                </a>

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-star"></i>

                    Reviews

                </a>

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-wallet"></i>

                    Earnings

                </a>

                <a href="#" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-800">

                    <i class="fa-solid fa-gear"></i>

                    Settings

                </a>

            </nav>

        </aside>

        <!-- Main Content -->

        <div class="flex-1">

            <!-- Top Bar -->

            <header class="bg-white shadow px-8 py-5 flex justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold">

                        Vendor Dashboard

                    </h1>

                    <p class="text-gray-500">

                        Welcome back, Vendor 👋

                    </p>

                </div>

                <div class="flex items-center gap-4">

                    <button class="relative">

                        <i class="fa-solid fa-bell text-2xl text-gray-600"></i>

                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">

                            3

                        </span>

                    </button>

                    <img src="https://ui-avatars.com/api/?name=Vendor" class="w-12 h-12 rounded-full">

                </div>

            </header>

            <main class="p-8">

                <!-- Statistics -->

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="flex justify-between">

                            <div>

                                <p class="text-gray-500">

                                    Total Bookings

                                </p>

                                <h2 class="text-4xl font-bold mt-2">

                                    156

                                </h2>

                            </div>

                            <i class="fa-solid fa-calendar-check text-red-500 text-4xl"></i>

                        </div>

                    </div>

                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="flex justify-between">

                            <div>

                                <p class="text-gray-500">

                                    Active Services

                                </p>

                                <h2 class="text-4xl font-bold mt-2">

                                    24

                                </h2>

                            </div>

                            <i class="fa-solid fa-gears text-green-500 text-4xl"></i>

                        </div>

                    </div>

                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="flex justify-between">

                            <div>

                                <p class="text-gray-500">

                                    Revenue

                                </p>

                                <h2 class="text-4xl font-bold mt-2">

                                    $8,750

                                </h2>

                            </div>

                            <i class="fa-solid fa-wallet text-blue-500 text-4xl"></i>

                        </div>

                    </div>

                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="flex justify-between">

                            <div>

                                <p class="text-gray-500">

                                    Rating

                                </p>

                                <h2 class="text-4xl font-bold mt-2">

                                    4.9★

                                </h2>

                            </div>

                            <i class="fa-solid fa-star text-yellow-500 text-4xl"></i>

                        </div>

                    </div>

                </div>

                <!-- Recent Bookings -->

                <div class="bg-white mt-10 rounded-xl shadow">

                    <div class="border-b px-6 py-4 flex justify-between">

                        <h2 class="text-xl font-bold">

                            Recent Bookings

                        </h2>

                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg">

                            View All

                        </button>

                    </div>

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-4 text-left">Customer</th>

                                <th class="p-4 text-left">Service</th>

                                <th class="p-4 text-left">Date</th>

                                <th class="p-4 text-left">Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr class="border-b">

                                <td class="p-4">Ahmed Ali</td>

                                <td class="p-4">Oil Change</td>

                                <td class="p-4">22 Jul 2026</td>

                                <td class="p-4">

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                        Completed

                                    </span>

                                </td>

                            </tr>

                            <tr>

                                <td class="p-4">John Smith</td>

                                <td class="p-4">Car Wash</td>

                                <td class="p-4">23 Jul 2026</td>

                                <td class="p-4">

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                        Pending

                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </main>

        </div>

    </div>

</body>

</html>
