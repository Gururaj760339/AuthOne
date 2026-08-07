<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Spare Parts Orders - Vendor</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">


    <div class="max-w-7xl mx-auto px-5 py-10">

        {{-- Header --}}

        <div
            class="flex flex-col md:flex-row
                md:items-center md:justify-between
                gap-4 mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">

                    Spare Parts Orders

                </h1>

                <p class="text-gray-500 mt-1">

                    Manage your spare parts orders

                </p>

            </div>

            <a href="{{ url('/vendor/dashboard') }}" class="bg-gray-800 text-white px-5 py-3 rounded-lg">

                ← Dashboard

            </a>

        </div>


        {{-- Success Message --}}

        @if (session('success'))
            <div
                class="bg-green-100
                    text-green-700
                    px-5 py-4
                    rounded-lg
                    mb-6">

                {{ session('success') }}

            </div>
        @endif


        {{-- Orders --}}

        @if ($orders->count())

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="text-left px-6 py-4">
                                    Order
                                </th>

                                <th class="text-left px-6 py-4">
                                    Customer
                                </th>

                                <th class="text-left px-6 py-4">
                                    Items
                                </th>

                                <th class="text-left px-6 py-4">
                                    Total
                                </th>

                                <th class="text-left px-6 py-4">
                                    Status
                                </th>

                                <th class="text-left px-6 py-4">
                                    Date
                                </th>

                                <th class="text-left px-6 py-4">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50">

                                    {{-- Order --}}

                                    <td class="px-6 py-5">

                                        <p class="font-bold">

                                            {{ $order->order_number }}

                                        </p>

                                    </td>


                                    {{-- Customer --}}

                                    <td class="px-6 py-5">

                                        <p class="font-semibold">

                                            {{ $order->customer_name }}

                                        </p>

                                        <p class="text-sm text-gray-500">

                                            {{ $order->customer_phone }}

                                        </p>

                                    </td>


                                    {{-- Items --}}

                                    <td class="px-6 py-5">

                                        {{ $order->items->count() }}

                                        item(s)

                                    </td>


                                    {{-- Total --}}

                                    <td class="px-6 py-5">

                                        <span class="font-bold">

                                            AED
                                            {{ number_format($order->items->sum('subtotal'), 2) }}

                                        </span>

                                    </td>


                                    {{-- Status --}}

                                    <td class="px-6 py-5">

                                        @if ($order->status === 'pending')
                                            <span
                                                class="bg-yellow-100
                                                     text-yellow-700
                                                     px-3 py-1
                                                     rounded-full
                                                     text-sm">

                                                Pending

                                            </span>
                                        @elseif($order->status === 'confirmed')
                                            <span
                                                class="bg-blue-100
                                                     text-blue-700
                                                     px-3 py-1
                                                     rounded-full
                                                     text-sm">

                                                Confirmed

                                            </span>
                                        @elseif($order->status === 'processing')
                                            <span
                                                class="bg-purple-100
                                                     text-purple-700
                                                     px-3 py-1
                                                     rounded-full
                                                     text-sm">

                                                Processing

                                            </span>
                                        @elseif($order->status === 'shipped')
                                            <span
                                                class="bg-indigo-100
                                                     text-indigo-700
                                                     px-3 py-1
                                                     rounded-full
                                                     text-sm">

                                                Shipped

                                            </span>
                                        @elseif($order->status === 'delivered')
                                            <span
                                                class="bg-green-100
                                                     text-green-700
                                                     px-3 py-1
                                                     rounded-full
                                                     text-sm">

                                                Delivered

                                            </span>
                                        @elseif($order->status === 'cancelled')
                                            <span
                                                class="bg-red-100
                                                     text-red-700
                                                     px-3 py-1
                                                     rounded-full
                                                     text-sm">

                                                Cancelled

                                            </span>
                                        @endif

                                    </td>


                                    {{-- Date --}}

                                    <td class="px-6 py-5 text-sm text-gray-500">

                                        {{ $order->ordered_at?->format('d M Y') }}

                                    </td>


                                    {{-- Action --}}

                                    <td class="px-6 py-5">

                                        <a href="{{ route('vendor.spare-parts.orders.show', $order->id) }}"
                                            class="bg-blue-600
                                               text-white
                                               px-4 py-2
                                               rounded-lg">

                                            View

                                        </a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Pagination --}}

            <div class="mt-6">

                {{ $orders->links() }}

            </div>
        @else
            <div
                class="bg-white
                    rounded-xl
                    shadow
                    p-12
                    text-center">

                <div class="text-6xl mb-5">

                    📦

                </div>

                <h2 class="text-2xl font-bold">

                    No Orders Found

                </h2>

                <p class="text-gray-500 mt-2">

                    You don't have any spare parts orders yet.

                </p>

            </div>

        @endif

    </div>


</body>

</html>
