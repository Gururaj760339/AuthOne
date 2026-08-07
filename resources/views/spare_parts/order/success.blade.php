<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Successful - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100">


    <div class="min-h-screen flex items-center justify-center px-5">


        <div class="bg-white shadow-xl rounded-2xl p-10 text-center max-w-lg w-full">


            <div class="text-6xl mb-5">

                ✓

            </div>


            <h1 class="text-3xl font-bold text-gray-800">

                Order Placed Successfully!

            </h1>


            <p class="text-gray-500 mt-3">

                Thank you for shopping with AutoOne.

            </p>


            <div class="bg-gray-100 rounded-lg p-5 mt-6">

                <p class="text-gray-500">

                    Order Number

                </p>

                <p class="text-2xl font-bold text-blue-600 mt-1">

                    {{ $order->order_number }}

                </p>

            </div>


            <div class="mt-6">

                <p class="text-gray-600">

                    Total Amount

                </p>

                <p class="text-2xl font-bold">

                    AED {{ number_format($order->total_amount, 2) }}

                </p>

            </div>


            <div class="flex flex-col gap-3 mt-8">


                <a href="{{ route('customer.order.details', $order->id) }}"
                    class="bg-blue-600 text-white py-3 rounded-lg font-semibold">

                    View Order

                </a>


                <a href="{{ route('customer.orders.history') }}" class="border border-gray-300 py-3 rounded-lg font-semibold">

                    Order History

                </a>


                <a href="{{ url('/') }}" class="text-gray-600 py-2">

                    Continue Shopping

                </a>


            </div>


        </div>

    </div>


</body>

</html>
