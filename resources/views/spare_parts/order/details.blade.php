<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Details - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100">


    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-5 py-5 flex justify-between">

            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">

                AutoOne

            </a>


            <a href="{{ route('customer.orders.history') }}" class="text-gray-600">

                ← Order History

            </a>

        </div>

    </header>



    <main class="max-w-6xl mx-auto px-5 py-10">


        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold">

                    Order Details

                </h1>

                <p class="text-gray-500 mt-1">

                    {{ $order->order_number }}

                </p>

            </div>


            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                {{ ucfirst($order->status) }}

            </span>

        </div>



        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            {{-- Items --}}

            <div class="lg:col-span-2">


                <div class="bg-white rounded-xl shadow p-6">


                    <h2 class="text-xl font-bold mb-6">

                        Ordered Items

                    </h2>


                    <div class="space-y-5">


                        @foreach ($order->items as $item)
                            <div class="flex justify-between border-b pb-5">


                                <div>

                                    <h3 class="font-semibold">

                                        {{ $item->part_name }}

                                    </h3>

                                    <p class="text-gray-500">

                                        Quantity: {{ $item->quantity }}

                                    </p>

                                    <p class="text-gray-500">

                                        Price: AED {{ number_format($item->price, 2) }}

                                    </p>

                                </div>


                                <div class="font-bold">

                                    AED {{ number_format($item->subtotal, 2) }}

                                </div>


                            </div>
                        @endforeach


                    </div>


                    <div class="mt-6 space-y-3">


                        <div class="flex justify-between">

                            <span>Subtotal</span>

                            <span>

                                AED {{ number_format($order->subtotal, 2) }}

                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span>Shipping</span>

                            <span>

                                AED {{ number_format($order->shipping_cost, 2) }}

                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span>Tax</span>

                            <span>

                                AED {{ number_format($order->tax, 2) }}

                            </span>

                        </div>


                        <div class="border-t pt-4 flex justify-between text-xl font-bold">

                            <span>Total</span>

                            <span class="text-blue-600">

                                AED {{ number_format($order->total_amount, 2) }}

                            </span>

                        </div>


                    </div>


                </div>

            </div>



            {{-- Customer Info --}}

            <div>


                <div class="bg-white rounded-xl shadow p-6">


                    <h2 class="text-xl font-bold mb-5">

                        Delivery Information

                    </h2>


                    <div class="space-y-4">


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

                                Address

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


                    <hr class="my-6">


                    <h2 class="text-xl font-bold mb-5">

                        Payment

                    </h2>


                    <p>

                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}

                    </p>


                    <p class="mt-2">

                        Payment Status:

                        <strong>

                            {{ ucfirst($order->payment_status) }}

                        </strong>

                    </p>


                </div>

            </div>


        </div>


    </main>


</body>

</html>
