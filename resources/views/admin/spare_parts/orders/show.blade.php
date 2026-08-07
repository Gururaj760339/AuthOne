<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Spare Parts Orders - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100">


    <div class="max-w-7xl mx-auto px-5 py-10">


        {{-- Header --}}

        <div
            class="flex flex-col md:flex-row
                md:items-center
                md:justify-between
                gap-4 mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">

                    Spare Parts Orders

                </h1>

                <p class="text-gray-500 mt-1">

                    Manage all AutoOne spare parts orders

                </p>

            </div>


            <a href="{{ url('/admin/dashboard') }}"
                class="bg-gray-800 text-white
                   px-5 py-3 rounded-lg">

                ← Dashboard

            </a>

        </div>



        {{-- Success --}}

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



        {{-- Search + Filters --}}

        <div class="bg-white rounded-xl shadow p-6 mb-6">


            <form method="GET" action="{{ route('admin.spare-parts.orders') }}"
                class="grid grid-cols-1
                   md:grid-cols-2
                   lg:grid-cols-4
                   gap-4">


                {{-- Search --}}

                <div>

                    <label class="block text-sm
                              font-semibold mb-2">

                        Search

                    </label>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Order number, name, phone..."
                        class="w-full border
                           rounded-lg
                           px-4 py-3">

                </div>



                {{-- Order Status --}}

                <div>

                    <label class="block text-sm
                              font-semibold mb-2">

                        Order Status

                    </label>

                    <select name="status"
                        class="w-full border
                           rounded-lg
                           px-4 py-3">

                        <option value="">
                            All Status
                        </option>

                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>
                            Confirmed
                        </option>

                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>
                            Processing
                        </option>

                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>
                            Shipped
                        </option>

                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>
                            Delivered
                        </option>

                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                </div>



                {{-- Payment Status --}}

                <div>

                    <label class="block text-sm
                              font-semibold mb-2">

                        Payment Status

                    </label>

                    <select name="payment_status"
                        class="w-full border
                           rounded-lg
                           px-4 py-3">

                        <option value="">
                            All Payments
                        </option>

                        <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                        <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>
                            Failed
                        </option>

                        <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>
                            Refunded
                        </option>

                    </select>

                </div>



                {{-- Buttons --}}

                <div class="flex items-end gap-3">

                    <button type="submit"
                        class="bg-blue-600
                           hover:bg-blue-700
                           text-white
                           px-5 py-3
                           rounded-lg
                           font-semibold">

                        Filter

                    </button>


                    <a href="{{ route('admin.spare-parts.orders') }}"
                        class="bg-gray-200
                           text-gray-700
                           px-5 py-3
                           rounded-lg">

                        Reset

                    </a>

                </div>


            </form>

        </div>



        {{-- Orders Table --}}

        <div class="bg-white
                rounded-xl
                shadow
                overflow-hidden">


            @if ($orders->count())


                <div class="overflow-x-auto">


                    <table class="w-full">


                        <thead class="bg-gray-50">

                            <tr>

                                <th class="text-left
                                       px-6 py-4">
                                    Order
                                </th>

                                <th class="text-left
                                       px-6 py-4">
                                    Customer
                                </th>

                                <th class="text-left
                                       px-6 py-4">
                                    Items
                                </th>

                                <th class="text-left
                                       px-6 py-4">
                                    Amount
                                </th>

                                <th class="text-left
                                       px-6 py-4">
                                    Payment
                                </th>

                                <th class="text-left
                                       px-6 py-4">
                                    Status
                                </th>

                                <th class="text-left
                                       px-6 py-4">
                                    Date
                                </th>

                                <th class="text-left
                                       px-6 py-4">
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

                                        <p class="text-sm
                                              text-gray-500">

                                            {{ $order->customer_phone }}

                                        </p>

                                    </td>



                                    {{-- Items --}}

                                    <td class="px-6 py-5">

                                        {{ $order->items->count() }}

                                        item(s)

                                    </td>



                                    {{-- Amount --}}

                                    <td class="px-6 py-5">

                                        <p class="font-bold">

                                            {{ $order->currency }}

                                            {{ number_format($order->total_amount, 2) }}

                                        </p>

                                    </td>



                                    {{-- Payment --}}

                                    <td class="px-6 py-5">

                                        <p class="text-sm">

                                            {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}

                                        </p>


                                        @if ($order->payment_status === 'paid')
                                            <span
                                                class="inline-block
                                                   mt-1
                                                   bg-green-100
                                                   text-green-700
                                                   px-2 py-1
                                                   rounded-full
                                                   text-xs">

                                                Paid

                                            </span>
                                        @elseif($order->payment_status === 'failed')
                                            <span
                                                class="inline-block
                                                   mt-1
                                                   bg-red-100
                                                   text-red-700
                                                   px-2 py-1
                                                   rounded-full
                                                   text-xs">

                                                Failed

                                            </span>
                                        @elseif($order->payment_status === 'refunded')
                                            <span
                                                class="inline-block
                                                   mt-1
                                                   bg-purple-100
                                                   text-purple-700
                                                   px-2 py-1
                                                   rounded-full
                                                   text-xs">

                                                Refunded

                                            </span>
                                        @else
                                            <span
                                                class="inline-block
                                                   mt-1
                                                   bg-yellow-100
                                                   text-yellow-700
                                                   px-2 py-1
                                                   rounded-full
                                                   text-xs">

                                                Pending

                                            </span>
                                        @endif

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
                                        @else
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

                                    <td
                                        class="px-6 py-5
                                           text-sm
                                           text-gray-500">

                                        {{ $order->ordered_at?->format('d M Y') }}

                                    </td>



                                    {{-- Action --}}

                                    <td class="px-6 py-5">

                                        <a href="{{ route('admin.spare-parts.orders.show', $order->id) }}"
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



                {{-- Pagination --}}

                <div class="p-6">

                    {{ $orders->links() }}

                </div>
            @else
                <div class="p-12 text-center">

                    <div class="text-6xl mb-5">

                        📦

                    </div>

                    <h2 class="text-2xl font-bold">

                        No Orders Found

                    </h2>

                    <p class="text-gray-500 mt-2">

                        There are no spare parts orders matching your search.

                    </p>

                </div>


            @endif


        </div>


    </div>


</body>

</html>
