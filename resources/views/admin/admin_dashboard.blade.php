<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoOne Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-72 bg-slate-900 text-gray-200 min-h-screen flex flex-col shadow-2xl">

            <!-- Logo -->
            <div class="px-6 py-6 border-b border-slate-700 flex items-center gap-3">

                @if ($setting && $setting->logo)
                    <img src="{{ asset($setting->logo) }}" class="w-12 h-12 rounded-lg bg-white p-1" alt="Logo">
                @else
                    <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center text-2xl">
                        🚗
                    </div>
                @endif

                <div>
                    <h2 class="text-xl font-bold">
                        {{ $setting?->website_name ?? 'AutoOne' }}
                    </h2>

                    <p class="text-xs text-gray-400">
                        Admin Panel
                    </p>
                </div>

            </div>

            <!-- Menu -->
            <div class="flex-1 overflow-y-auto">

                <p class="text-xs uppercase tracking-widest text-gray-500 px-6 mt-6 mb-2">
                    Main Menu
                </p>

                <nav class="space-y-1 px-3">

                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white">

                        📊 <span>Dashboard</span>

                    </a>

                    <a href="{{ route('admin.users') }}"
                        class="block px-4 py-2 rounded hover:bg-red-600 hover:text-white">
                        👥 Users
                    </a>

                    <a href="{{ route('admin.finance.partner') }}"
                        class="block px-4 py-2 rounded hover:bg-red-600 hover:text-white">
                        👥 Finance Partner
                    </a>

                    <a href="{{ route('admin.cars') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        🚗 <span>Cars</span>

                    </a>

                    <a href="{{ route('admin.car.brand.show') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        🏷️ <span>Car Brands</span>

                    </a>

                    <a href="{{ route('admin.cars.images') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        🖼️ <span>Car Images</span>

                    </a>

                    <a href="{{ route('admin.service.category') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        📂 <span>Service Categories</span>

                    </a>

                    <a href="{{ route('admin.service') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        🔧 <span>Services</span>

                    </a>

                    <a href="{{ route('admin.booking') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        📅 <span>Bookings</span>

                    </a>

                    <a href="{{ route('admin.rental') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        🚙 <span>Rentals</span>

                    </a>

                    <a href="{{ route('admin.rental.booking') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        📑 <span>Rental Bookings</span>

                    </a>

                    <a href="{{ route('admin.finance.request') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        💳 <span>Finance Requests</span>

                    </a>

                    <a href="{{ route('admin.import.request') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        🚢 <span>Import Requests</span>

                    </a>

                    <a href="{{ route('admin.review') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        ⭐ <span>Testimonials</span>

                    </a>

                    <a href="{{ route('admin.faq') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        ❓ <span>FAQs</span>

                    </a>

                    <a href="{{ route('admin.contact') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        📩 <span>Contacts</span>

                    </a>

                    <a href="{{ route('admin.setting') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

                        ⚙️ <span>Settings</span>

                    </a>

                </nav>

            </div>

            <!-- Footer -->
            <div class="border-t border-slate-700 p-4">

                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf

                    <button class="w-full bg-red-600 hover:bg-red-700 transition rounded-lg py-3 font-semibold">

                        🚪 Logout

                    </button>

                </form>

            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1">

            <!-- Navbar -->
            <header class="bg-white shadow px-8 py-5 flex justify-between items-center">

                <h1 class="text-3xl font-bold text-slate-700">
                    Dashboard
                </h1>

                <div class="flex items-center gap-4">

                    <span class="text-slate-600">
                        Welcome, Admin
                    </span>

                    <img src="https://i.pravatar.cc/45" class="rounded-full">

                </div>

            </header>

            <!-- Content -->
            <div class="p-8">

                <!-- Dashboard Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Total Cars -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
                        <p class="text-gray-500">🚗 Total Cars</p>
                        <h2 class="text-4xl font-bold mt-3 text-blue-600">
                            {{ $totalCars }}
                        </h2>
                    </div>

                    <!-- Car Brands -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition">
                        <p class="text-gray-500">🏷️ Car Brands</p>
                        <h2 class="text-4xl font-bold mt-3 text-green-600">
                            {{ $totalBrands }}
                        </h2>
                    </div>

                    <!-- Services -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-xl transition">
                        <p class="text-gray-500">🛠️ Services</p>
                        <h2 class="text-4xl font-bold mt-3 text-yellow-600">
                            {{ $totalServices }}
                        </h2>
                    </div>

                    <!-- Service Bookings -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-xl transition">
                        <p class="text-gray-500">📅 Bookings</p>
                        <h2 class="text-4xl font-bold mt-3 text-purple-600">
                            {{ $totalBookings }}
                        </h2>
                    </div>

                    <!-- Rental Bookings -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-pink-500 hover:shadow-xl transition">
                        <p class="text-gray-500">🚙 Rental Bookings</p>
                        <h2 class="text-4xl font-bold mt-3 text-pink-600">
                            {{ $totalRentalBookings }}
                        </h2>
                    </div>

                    <!-- Finance Requests -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-indigo-500 hover:shadow-xl transition">
                        <p class="text-gray-500">💳 Finance Requests</p>
                        <h2 class="text-4xl font-bold mt-3 text-indigo-600">
                            {{ $totalFinanceRequests }}
                        </h2>
                    </div>

                    <!-- Import Requests -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-red-500 hover:shadow-xl transition">
                        <p class="text-gray-500">🚢 Import Requests</p>
                        <h2 class="text-4xl font-bold mt-3 text-red-600">
                            {{ $totalImportRequests }}
                        </h2>
                    </div>

                    <!-- Contacts -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-teal-500 hover:shadow-xl transition">
                        <p class="text-gray-500">📩 Contacts</p>
                        <h2 class="text-4xl font-bold mt-3 text-teal-600">
                            {{ $totalContacts }}
                        </h2>
                    </div>

                </div>

                <!-- Recent Bookings -->
                <div class="bg-white rounded-xl shadow mt-10">

                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-bold">
                            Recent Service Bookings
                        </h2>
                    </div>

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="text-left p-4">Customer</th>
                                <th class="text-left p-4">Service</th>
                                <th class="text-left p-4">Date</th>
                                <th class="text-left p-4">Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentBookings as $booking)
                                <tr class="border-b">

                                    <td class="p-4">
                                        {{ $booking->user->name }}
                                    </td>

                                    <td class="p-4">
                                        {{ $booking->service->title }}
                                    </td>

                                    <td class="p-4">
                                        {{ $booking->booking_date }}
                                    </td>

                                    <td class="p-4">

                                        @if ($booking->status == 'Pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                                Pending
                                            </span>
                                        @elseif($booking->status == 'Confirmed')
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                                Confirmed
                                            </span>
                                        @elseif($booking->status == 'Completed')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                Completed
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                                Cancelled
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center p-5">
                                        No Booking Found
                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- Bottom Section -->
                <div class="grid lg:grid-cols-2 gap-8 mt-10">

                    <!-- Finance Requests -->
                    <div class="bg-white rounded-xl shadow p-6">

                        <h2 class="text-xl font-bold mb-5">
                            Latest Finance Requests
                        </h2>

                        <div class="space-y-4">

                            @forelse($latestFinanceRequests as $finance)
                                <div class="flex justify-between border-b pb-2">

                                    <span>
                                        {{ $finance->car->title }}
                                    </span>

                                    <span>

                                        @if ($finance->status == 'Pending')
                                            <span class="text-yellow-600">Pending</span>
                                        @elseif($finance->status == 'Approved')
                                            <span class="text-green-600">Approved</span>
                                        @else
                                            <span class="text-red-600">Rejected</span>
                                        @endif

                                    </span>

                                </div>

                            @empty

                                <p>No Finance Request</p>
                            @endforelse

                        </div>

                    </div>

                    <!-- Import Requests -->
                    <div class="bg-white rounded-xl shadow p-6">

                        <h2 class="text-xl font-bold mb-5">
                            Latest Import Requests
                        </h2>

                        <div class="space-y-4">

                            @forelse($latestImportRequests as $import)
                                <div class="flex justify-between border-b pb-2">

                                    <span>

                                        {{ $import->car_name }}

                                    </span>

                                    <span>

                                        {{ $import->country }}

                                    </span>

                                </div>

                            @empty

                                <p>No Import Request</p>
                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>

</html>
