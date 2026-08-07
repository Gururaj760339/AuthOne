<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    {{-- Header --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-5 py-5 flex justify-between items-center">

            <a href="{{ url('/') }}"
               class="text-2xl font-bold text-blue-600">
                AutoOne
            </a>

            <a href="{{ url('/') }}"
               class="text-gray-600 hover:text-blue-600">
                Continue Shopping
            </a>

        </div>
    </header>


    <main class="max-w-7xl mx-auto px-5 py-10">

        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            Shopping Cart
        </h1>


        {{-- Success --}}
        @if(session('success'))

            <div class="bg-green-100 text-green-700 px-5 py-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>

        @endif


        {{-- Error --}}
        @if(session('error'))

            <div class="bg-red-100 text-red-700 px-5 py-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>

        @endif


        @if($cart->items->count())

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-5">

                    @foreach($cart->items as $item)

                        <div class="bg-white rounded-xl shadow p-5">

                            <div class="flex flex-col md:flex-row gap-5">

                                {{-- Image --}}
                                <div class="w-full md:w-32 h-32">

                                    @if($item->sparePart->image)

                                        <img
                                            src="{{ asset('storage/' . $item->sparePart->image) }}"
                                            class="w-full h-full object-cover rounded-lg"
                                            alt="{{ $item->sparePart->name }}"
                                        >

                                    @else

                                        <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                            No Image
                                        </div>

                                    @endif

                                </div>


                                {{-- Details --}}
                                <div class="flex-1">

                                    <h2 class="text-xl font-bold text-gray-800">
                                        {{ $item->sparePart->name }}
                                    </h2>

                                    <p class="text-gray-500 mt-1">
                                        {{ $item->sparePart->description }}
                                    </p>


                                    <div class="mt-3">

                                        <span class="text-blue-600 font-bold text-lg">
                                            AED {{ number_format($item->price, 2) }}
                                        </span>

                                    </div>


                                    {{-- Quantity --}}
                                    <form
                                        action="{{ route('customer.cart.update', $item->id) }}"
                                        method="POST"
                                        class="flex items-center gap-3 mt-4"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            class="border rounded-lg px-3 py-2 w-24"
                                        >

                                        <button
                                            type="submit"
                                            class="bg-gray-800 text-white px-4 py-2 rounded-lg"
                                        >
                                            Update
                                        </button>

                                    </form>


                                    {{-- Remove --}}
                                    <form
                                        action="{{ route('customer.cart.remove', $item->id) }}"
                                        method="POST"
                                        class="mt-3"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-800"
                                        >
                                            Remove
                                        </button>

                                    </form>

                                </div>


                                {{-- Subtotal --}}
                                <div class="text-right">

                                    <p class="text-gray-500">
                                        Subtotal
                                    </p>

                                    <p class="text-xl font-bold text-gray-800">
                                        AED
                                        {{ number_format($item->subtotal, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endforeach


                    {{-- Clear Cart --}}
                    <form
                        action="{{ route('customer.cart.clear') }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="text-red-600 font-semibold"
                        >
                            Clear Cart
                        </button>

                    </form>

                </div>


                {{-- Cart Summary --}}
                <div>

                    <div class="bg-white rounded-xl shadow p-6 sticky top-5">

                        <h2 class="text-xl font-bold text-gray-800 mb-6">
                            Order Summary
                        </h2>


                        <div class="flex justify-between mb-4">

                            <span class="text-gray-600">
                                Subtotal
                            </span>

                            <span class="font-semibold">
                                AED {{ number_format($cart->total, 2) }}
                            </span>

                        </div>


                        <div class="flex justify-between mb-4">

                            <span class="text-gray-600">
                                Shipping
                            </span>

                            <span class="font-semibold">
                                AED 0.00
                            </span>

                        </div>


                        <hr class="my-5">


                        <div class="flex justify-between text-xl font-bold">

                            <span>
                                Total
                            </span>

                            <span class="text-blue-600">
                                AED {{ number_format($cart->total, 2) }}
                            </span>

                        </div>


                        {{-- Checkout --}}
                        <a
                            href="{{ route('customer.checkout') }}"
                            class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg mt-6"
                        >
                            Proceed to Checkout
                        </a>

                    </div>

                </div>

            </div>

        @else

            {{-- Empty Cart --}}
            <div class="bg-white rounded-xl shadow p-12 text-center">

                <div class="text-6xl mb-5">
                    🛒
                </div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Your cart is empty
                </h2>

                <p class="text-gray-500 mt-2">
                    Add some spare parts to your cart.
                </p>

                <a
                    href="{{ url('/') }}"
                    class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg"
                >
                    Browse Spare Parts
                </a>

            </div>

        @endif

    </main>

</body>

</html>