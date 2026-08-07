<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Order {{ $order->order_number }} - Vendor
    </title>
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

                <h1 class="text-3xl font-bold">

                    Order Details

                </h1>

                <p class="text-gray-500 mt-1">

                    {{ $order->order_number }}

                </p>

            </div>


            <a href="{{ route('vendor.spare-parts.orders') }}" class="bg-gray-800 text-white px-5 py-3 rounded-lg">

                ← Back to Orders

            </a>

        </div>



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



        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            {{-- Order Items --}}

            <div class="lg:col-span-2">


                <div class="bg-white rounded-xl shadow p-6">


                    <h2 class="text-xl font-bold mb-6">

                        Ordered Spare Parts

                    </h2>



                    <div class="space-y-5">


                        @foreach ($order->items as $item)
                            <div
                                class="flex flex-col md:flex-row
            md:items-center
            md:justify-between
            gap-4
            border-b
            pb-5">


                                <div>


                                    <h3 class="font-bold text-lg">

                                        {{ $item->part_name }}

                                    </h3>


                                    <p class="text-gray-500">

                                        Quantity: {{ $item->quantity }}

                                    </p>


                                    <p class="text-gray-500">

                                        Unit Price:

                                        AED {{ number_format($item->price, 2) }}

                                    </p>

                                </div>


                                <div class="text-right">

                                    <p class="text-gray-500">

                                        Subtotal

                                    </p>


                                    <p class="text-xl font-bold text-blue-600">

                                        AED {{ number_format($item->subtotal, 2) }}

                                    </p>

                                </div>


                            </div>
                        @endforeach


                    </div>



                    <div class="border-t mt-6 pt-6">


                        <div class="flex justify-between mb-3">

                            <span>

                                Your Items Subtotal

                            </span>

                            <span class="font-bold">

                                AED
                                {{ number_format($order->items->sum('subtotal'), 2) }}

                            </span>

                        </div>


                        <div class="flex justify-between text-xl font-bold">

                            <span>

                                Total

                            </span>

                            <span class="text-blue-600">

                                AED
                                {{ number_format($order->items->sum('subtotal'), 2) }}

                            </span>

                        </div>


                    </div>


                </div>


                {{-- Customer --}}

                <div class="bg-white rounded-xl shadow p-6 mt-6">


                    <h2 class="text-xl font-bold mb-6">

                        Customer Information

                    </h2>


                    <div class="space-y-5">


                        <div>

                            <p class="text-sm text-gray-500">

                                Name

                            </p>

                            <p class="font-semibold">

                                {{ $order->customer_name }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                Phone

                            </p>

                            <p class="font-semibold">

                                {{ $order->customer_phone }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                Email

                            </p>

                            <p>

                                {{ $order->customer_email ?? 'N/A' }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                Shipping Address

                            </p>

                            <p>

                                {{ $order->shipping_address }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                City

                            </p>

                            <p>

                                {{ $order->shipping_city }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                Country

                            </p>

                            <p>

                                {{ $order->shipping_country }}

                            </p>

                        </div>


                    </div>

                </div>


            </div>



            {{-- Right Side --}}

            <div>


                {{-- Status --}}

                <div class="bg-white rounded-xl shadow p-6">


                    <h2 class="text-xl font-bold mb-6">

                        Order Status

                    </h2>


                    <form action="{{ route('vendor.spare-parts.orders.status', $order->id) }}" method="POST">

                        @csrf

                        @method('PUT')


                        <select name="status" class="w-full border rounded-lg px-4 py-3">


                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>

                                Pending

                            </option>


                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>

                                Confirmed

                            </option>


                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>

                                Processing

                            </option>


                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>

                                Shipped

                            </option>


                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>

                                Delivered

                            </option>


                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>

                                Cancelled

                            </option>


                        </select>


                        <button type="submit"
                            class="w-full
           bg-blue-600
           hover:bg-blue-700
           text-white
           font-semibold
           py-3
           rounded-lg
           mt-4">

                            Update Status

                        </button>


                    </form>

                </div>



                {{-- Payment --}}

                <div class="bg-white rounded-xl shadow p-6 mt-6">


                    <h2 class="text-xl font-bold mb-5">

                        Payment

                    </h2>


                    <div class="space-y-4">


                        <div>

                            <p class="text-sm text-gray-500">

                                Method

                            </p>

                            <p class="font-semibold">

                                {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                Payment Status

                            </p>

                            <p class="font-semibold">

                                {{ ucfirst($order->payment_status) }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">

                                Order Date

                            </p>

                            <p>

                                {{ $order->ordered_at?->format('d M Y, h:i A') }}

                            </p>

                        </div>


                    </div>


                </div>


            </div>


        </div>


    </div>


</body>

</html>
