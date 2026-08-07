<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100">


    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-5 py-5 flex justify-between">

            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">

                AutoOne

            </a>


            <a href="{{ route('customer.cart') }}" class="text-gray-600 hover:text-blue-600">

                ← Back to Cart

            </a>

        </div>

    </header>



    <main class="max-w-7xl mx-auto px-5 py-10">


        <h1 class="text-3xl font-bold text-gray-800 mb-8">

            Checkout

        </h1>



        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-5 py-4 rounded-lg mb-6">

                {{ session('error') }}

            </div>
        @endif



        <form action="{{ route('customer.checkout.place') }}" method="POST">

            @csrf


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


                {{-- Customer Information --}}

                <div class="lg:col-span-2">


                    <div class="bg-white rounded-xl shadow p-6 mb-6">


                        <h2 class="text-xl font-bold mb-6">

                            Customer Information

                        </h2>



                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            <div>

                                <label class="block font-semibold mb-2">

                                    Full Name

                                </label>

                                <input type="text" name="customer_name"
                                    value="{{ old('customer_name', auth()->user()->name) }}" required
                                    class="w-full border rounded-lg px-4 py-3">

                                @error('customer_name')
                                    <p class="text-red-500 text-sm mt-1">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            <div>

                                <label class="block font-semibold mb-2">

                                    Phone

                                </label>

                                <input type="text" name="customer_phone"
                                    value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" required
                                    class="w-full border rounded-lg px-4 py-3">

                                @error('customer_phone')
                                    <p class="text-red-500 text-sm mt-1">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            <div class="md:col-span-2">

                                <label class="block font-semibold mb-2">

                                    Email

                                </label>

                                <input type="email" name="customer_email"
                                    value="{{ old('customer_email', auth()->user()->email) }}"
                                    class="w-full border rounded-lg px-4 py-3">

                            </div>

                        </div>

                    </div>



                    {{-- Shipping Address --}}

                    <div class="bg-white rounded-xl shadow p-6 mb-6">


                        <h2 class="text-xl font-bold mb-6">

                            Shipping Address

                        </h2>



                        <div class="space-y-5">


                            <div>

                                <label class="block font-semibold mb-2">

                                    Address

                                </label>

                                <textarea name="shipping_address" rows="4" required class="w-full border rounded-lg px-4 py-3">{{ old('shipping_address') }}</textarea>

                                @error('shipping_address')
                                    <p class="text-red-500 text-sm mt-1">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                                <div>

                                    <label class="block font-semibold mb-2">

                                        City

                                    </label>

                                    <input type="text" name="shipping_city" value="{{ old('shipping_city') }}"
                                        required class="w-full border rounded-lg px-4 py-3">

                                </div>



                                <div>

                                    <label class="block font-semibold mb-2">

                                        Country

                                    </label>

                                    <input type="text" name="shipping_country"
                                        value="{{ old('shipping_country', 'UAE') }}" required
                                        class="w-full border rounded-lg px-4 py-3">

                                </div>


                            </div>

                        </div>

                    </div>



                    {{-- Payment --}}

                    <div class="bg-white rounded-xl shadow p-6">


                        <h2 class="text-xl font-bold mb-6">

                            Payment Method

                        </h2>



                        <div class="space-y-4">


                            <label class="flex items-center gap-3 border p-4 rounded-lg cursor-pointer">

                                <input type="radio" name="payment_method" value="cash_on_delivery" checked>

                                <div>

                                    <p class="font-semibold">

                                        Cash on Delivery

                                    </p>

                                    <p class="text-sm text-gray-500">

                                        Pay when your spare parts arrive.

                                    </p>

                                </div>

                            </label>



                            <label class="flex items-center gap-3 border p-4 rounded-lg cursor-pointer">

                                <input type="radio" name="payment_method" value="stripe">

                                <div>

                                    <p class="font-semibold">

                                        Stripe

                                    </p>

                                    <p class="text-sm text-gray-500">

                                        Pay securely online.

                                    </p>

                                </div>

                            </label>



                            <label class="flex items-center gap-3 border p-4 rounded-lg cursor-pointer">

                                <input type="radio" name="payment_method" value="bkash">

                                <div>

                                    <p class="font-semibold">

                                        bKash

                                    </p>

                                </div>

                            </label>



                        </div>

                    </div>



                    {{-- Note --}}

                    <div class="bg-white rounded-xl shadow p-6 mt-6">


                        <label class="block font-semibold mb-2">

                            Order Note

                        </label>

                        <textarea name="customer_note" rows="3" class="w-full border rounded-lg px-4 py-3"
                            placeholder="Any special instruction?">{{ old('customer_note') }}</textarea>

                    </div>


                </div>



                {{-- Order Summary --}}

                <div>


                    <div class="bg-white rounded-xl shadow p-6 sticky top-5">


                        <h2 class="text-xl font-bold mb-6">

                            Your Order

                        </h2>



                        <div class="space-y-5">


                            @foreach ($cart->items as $item)
                                <div class="flex justify-between gap-4">


                                    <div>

                                        <p class="font-semibold">

                                            {{ $item->sparePart->name }}

                                        </p>

                                        <p class="text-sm text-gray-500">

                                            Qty: {{ $item->quantity }}

                                        </p>

                                    </div>


                                    <p class="font-semibold whitespace-nowrap">

                                        AED {{ number_format($item->price * $item->quantity, 2) }}

                                    </p>


                                </div>
                            @endforeach


                        </div>



                        <hr class="my-6">



                        <div class="flex justify-between mb-3">

                            <span class="text-gray-600">

                                Subtotal

                            </span>

                            <span class="font-semibold">

                                AED {{ number_format($subtotal, 2) }}

                            </span>

                        </div>



                        <div class="flex justify-between mb-3">

                            <span class="text-gray-600">

                                Shipping

                            </span>

                            <span class="font-semibold">

                                AED {{ number_format($shippingCost, 2) }}

                            </span>

                        </div>



                        <div class="flex justify-between mb-3">

                            <span class="text-gray-600">

                                Tax

                            </span>

                            <span class="font-semibold">

                                AED {{ number_format($tax, 2) }}

                            </span>

                        </div>



                        <hr class="my-5">



                        <div class="flex justify-between text-xl font-bold">

                            <span>

                                Total

                            </span>

                            <span class="text-blue-600">

                                AED {{ number_format($total, 2) }}

                            </span>

                        </div>



                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-lg font-bold mt-6">

                            Place Order

                        </button>


                    </div>

                </div>


            </div>

        </form>


    </main>


</body>

</html>
