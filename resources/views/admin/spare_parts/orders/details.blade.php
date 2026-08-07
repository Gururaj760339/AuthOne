<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Order {{ $order->order_number }} - Admin
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


            <a href="{{ route('admin.spare-parts.orders') }}"
                class="bg-gray-800
                   text-white
                   px-5 py-3
                   rounded-lg">

                ← Back to Orders

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



        <div class="grid grid-cols-1
                lg:grid-cols-3
                gap-8">


            {{-- LEFT --}}

            <div class="lg:col-span-2">


                {{-- Order Items --}}

                <div
                    class="bg-white
                        rounded-xl
                        shadow
                        p-6">


                    <h2 class="text-xl
                           font-bold
                           mb-6">

                        Ordered Spare Parts

                    </h2>



                    <div class="space-y-5">


                        @foreach ($order->items as $item)
                            <div class="border-b
                                   pb-5">


                                <div
                                    class="flex
                                       flex-col
                                       md:flex-row
                                       md:justify-between
                                       gap-4">


                                    <div>


                                        <h3 class="text-lg
                                               font-bold">

                                            {{ $item->part_name }}

                                        </h3>


                                        @if ($item->sparePart)
                                            <p
                                                class="text-sm
                                                   text-gray-500
                                                   mt-1">

                                                Vendor:

                                                {{ $item->sparePart->vendor?->name ?? 'N/A' }}

                                            </p>
                                        @endif


                                        <p class="text-gray-500
                                               mt-2">

                                            Quantity:

                                            {{ $item->quantity }}

                                        </p>


                                        <p class="text-gray-500">

                                            Unit Price:

                                            AED
                                            {{ number_format($item->price, 2) }}

                                        </p>


                                    </div>



                                    <div class="text-right">

                                        <p class="text-sm
                                               text-gray-500">

                                            Subtotal

                                        </p>


                                        <p
                                            class="text-xl
                                               font-bold
                                               text-blue-600">

                                            AED

                                            {{ number_format($item->subtotal, 2) }}

                                        </p>


                                    </div>


                                </div>


                            </div>
                        @endforeach


                    </div>



                    {{-- Summary --}}

                    <div
                        class="border-t
                           mt-6
                           pt-6
                           space-y-3">


                        <div class="flex
                               justify-between">

                            <span>

                                Subtotal

                            </span>


                            <span>

                                AED

                                {{ number_format($order->subtotal, 2) }}

                            </span>

                        </div>



                        <div class="flex
                               justify-between">

                            <span>

                                Shipping

                            </span>


                            <span>

                                AED

                                {{ number_format($order->shipping_cost, 2) }}

                            </span>

                        </div>



                        <div class="flex
                               justify-between">

                            <span>

                                Tax

                            </span>


                            <span>

                                AED

                                {{ number_format($order->tax, 2) }}

                            </span>

                        </div>



                        <div
                            class="flex
                               justify-between
                               text-xl
                               font-bold
                               border-t
                               pt-4">

                            <span>

                                Total

                            </span>


                            <span class="text-blue-600">

                                {{ $order->currency }}

                                {{ number_format($order->total_amount, 2) }}

                            </span>

                        </div>


                    </div>


                </div>



                {{-- Customer Information --}}

                <div
                    class="bg-white
                       rounded-xl
                       shadow
                       p-6
                       mt-6">


                    <h2 class="text-xl
                           font-bold
                           mb-6">

                        Customer Information

                    </h2>



                    <div
                        class="grid
                           grid-cols-1
                           md:grid-cols-2
                           gap-6">


                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Name

                            </p>

                            <p class="font-semibold">

                                {{ $order->customer_name }}

                            </p>

                        </div>



                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Phone

                            </p>

                            <p class="font-semibold">

                                {{ $order->customer_phone }}

                            </p>

                        </div>



                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Email

                            </p>

                            <p>

                                {{ $order->customer_email ?? 'N/A' }}

                            </p>

                        </div>



                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                City

                            </p>

                            <p>

                                {{ $order->shipping_city }}

                            </p>

                        </div>



                        <div class="md:col-span-2">

                            <p class="text-sm
                                   text-gray-500">

                                Shipping Address

                            </p>

                            <p>

                                {{ $order->shipping_address }}

                            </p>

                        </div>



                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Country

                            </p>

                            <p>

                                {{ $order->shipping_country }}

                            </p>

                        </div>


                    </div>


                    @if ($order->customer_note)
                        <div
                            class="mt-6
                               bg-yellow-50
                               p-4
                               rounded-lg">

                            <p class="font-semibold
                                   text-yellow-800">

                                Customer Note

                            </p>

                            <p class="text-yellow-700
                                   mt-1">

                                {{ $order->customer_note }}

                            </p>

                        </div>
                    @endif


                </div>


            </div>



            {{-- RIGHT --}}

            <div>


                {{-- Order Status --}}

                <div
                    class="bg-white
                       rounded-xl
                       shadow
                       p-6">


                    <h2 class="text-xl
                           font-bold
                           mb-6">

                        Order Status

                    </h2>



                    <form
                        action="{{ route('admin.spare-parts.orders.status', $order->id) }}"
                        method="POST">

                        @csrf

                        @method('PUT')


                        <select name="status"
                            class="w-full
                               border
                               rounded-lg
                               px-4
                               py-3">


                            @foreach ([
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'processing' => 'Processing',
        'shipped' => 'Shipped',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled',
    ] as $value => $label)
                                <option value="{{ $value }}"
                                    {{ $order->status === $value ? 'selected' : '' }}>

                                    {{ $label }}

                                </option>
                            @endforeach


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

                            Update Order Status

                        </button>


                    </form>


                </div>



                {{-- Payment --}}

                <div
                    class="bg-white
                       rounded-xl
                       shadow
                       p-6
                       mt-6">


                    <h2 class="text-xl
                           font-bold
                           mb-6">

                        Payment

                    </h2>



                    <p class="text-sm
                           text-gray-500">

                        Payment Method

                    </p>

                    <p class="font-semibold
                           mt-1">

                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}

                    </p>



                    <hr class="my-5">



                    <p class="text-sm
                           text-gray-500">

                        Payment Status

                    </p>



                    <form
                        action="{{ route('admin.spare-parts.orders.payment-status', $order->id) }}"
                        method="POST" class="mt-2">

                        @csrf

                        @method('PUT')


                        <select name="payment_status"
                            class="w-full
                               border
                               rounded-lg
                               px-4
                               py-3">


                            <option value="pending"
                                {{ $order->payment_status === 'pending' ? 'selected' : '' }}>

                                Pending

                            </option>


                            <option value="paid"
                                {{ $order->payment_status === 'paid' ? 'selected' : '' }}>

                                Paid

                            </option>


                            <option value="failed"
                                {{ $order->payment_status === 'failed' ? 'selected' : '' }}>

                                Failed

                            </option>


                            <option value="refunded"
                                {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>

                                Refunded

                            </option>


                        </select>


                        <button type="submit"
                            class="w-full
                               bg-green-600
                               hover:bg-green-700
                               text-white
                               font-semibold
                               py-3
                               rounded-lg
                               mt-4">

                            Update Payment

                        </button>


                    </form>


                </div>



                {{-- Order Information --}}

                <div
                    class="bg-white
                       rounded-xl
                       shadow
                       p-6
                       mt-6">


                    <h2 class="text-xl
                           font-bold
                           mb-5">

                        Order Information

                    </h2>


                    <div class="space-y-4">


                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Order Number

                            </p>

                            <p class="font-semibold">

                                {{ $order->order_number }}

                            </p>

                        </div>



                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Currency

                            </p>

                            <p class="font-semibold">

                                {{ $order->currency }}

                            </p>

                        </div>



                        <div>

                            <p class="text-sm
                                   text-gray-500">

                                Ordered At

                            </p>

                            <p>

                                {{ $order->ordered_at?->format('d M Y, h:i A') }}

                            </p>

                        </div>


                    </div>


                </div>



                {{-- Delete --}}

                <div
                    class="bg-white
                       rounded-xl
                       shadow
                       p-6
                       mt-6">

                    <form
                        action="{{ route('admin.spare-parts.orders.destroy', $order->id) }}"
                        method="POST"
                        onsubmit="return confirm(
                        'Are you sure you want to delete this order?'
                    )">

                        @csrf

                        @method('DELETE')


                        <button type="submit"
                            class="w-full
                               bg-red-600
                               hover:bg-red-700
                               text-white
                               font-semibold
                               py-3
                               rounded-lg">

                            Delete Order

                        </button>

                    </form>

                </div>


            </div>


        </div>


    </div>


</body>

</html>
