<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order History - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100">


    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-5 py-5 flex justify-between">

            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">

                AutoOne

            </a>


            <a href="{{ route('customer.cart') }}" class="text-gray-600 hover:text-blue-600">

                Cart

            </a>

        </div>

    </header>



    <main class="max-w-7xl mx-auto px-5 py-10">


        <h1 class="text-3xl font-bold text-gray-800 mb-8">

            Order History

        </h1>



        @if ($orders->count())


            <div class="space-y-5">


                @foreach ($orders as $order)
                    <div class="bg-white rounded-xl shadow p-6">


                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">


                            <div>


                                <p class="text-sm text-gray-500">

                                    Order Number

                                </p>


                                <h2 class="text-xl font-bold">

                                    {{ $order->order_number }}

                                </h2>


                                <p class="text-sm text-gray-500 mt-2">

                                    {{ $order->ordered_at?->format('d M Y, h:i A') }}

                                </p>

                            </div>



                            <div>

                                <p class="text-sm text-gray-500">

                                    Total

                                </p>


                                <p class="text-xl font-bold text-blue-600">

                                    AED {{ number_format($order->total_amount, 2) }}

                                </p>

                            </div>



                            <div>

                                <p class="text-sm text-gray-500 mb-1">

                                    Status

                                </p>


                                @if ($order->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                        Pending

                                    </span>
                                @elseif($order->status === 'confirmed')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                        Confirmed

                                    </span>
                                @elseif($order->status === 'processing')
                                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">

                                        Processing

                                    </span>
                                @elseif($order->status === 'shipped')
                                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">

                                        Shipped

                                    </span>
                                @elseif($order->status === 'delivered')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        Delivered

                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                        Cancelled

                                    </span>
                                @endif

                            </div>



                            <div>

                                <a href="{{ route('customer.order.details', $order->id) }}"
                                    class="bg-blue-600 text-white px-5 py-2 rounded-lg">

                                    View

                                </a>

                            </div>


                        </div>


                        <div class="border-t mt-5 pt-5">


                            <p class="text-gray-500">

                                {{ $order->items->count() }} item(s)

                            </p>


                        </div>


                    </div>
                @endforeach


            </div>



            <div class="mt-8">

                {{ $orders->links() }}

            </div>
        @else
            <div class="bg-white rounded-xl shadow p-12 text-center">


                <div class="text-6xl mb-5">

                    📦

                </div>


                <h2 class="text-2xl font-bold">

                    No Orders Yet

                </h2>


                <p class="text-gray-500 mt-2">

                    You haven't placed any spare parts orders yet.

                </p>


                <a href="{{ url('/') }}" class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg">

                    Shop Spare Parts

                </a>


            </div>


        @endif


    </main>


</body>

</html>
