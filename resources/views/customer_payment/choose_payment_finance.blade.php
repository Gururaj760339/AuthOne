<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Payment Method</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                💳
            </div>

            <h2 class="text-3xl font-bold text-gray-800">
                Choose Payment
            </h2>

            <p class="text-gray-500 mt-2">
                Select your preferred payment method
            </p>
        </div>

        <!-- Stripe -->
        <a href="{{ route('stripe.checkout', ['type' => 'finance', 'id' => $finance->id]) }}"
            class="flex items-center justify-between bg-indigo-600 hover:bg-indigo-700 transition duration-300 text-white rounded-xl p-5 mb-4 shadow-lg">

            <div class="flex items-center gap-3">
                <span class="text-3xl">💳</span>

                <div>
                    <h3 class="font-semibold text-lg">
                        Stripe
                    </h3>
                    <p class="text-sm text-indigo-100">
                        Visa, Mastercard & More
                    </p>
                </div>
            </div>

            <span class="text-xl">→</span>
        </a>

        <!-- PayPal -->
        {{-- 
        <a href="{{ route('paypal.checkout', $finance->id) }}"
            class="flex items-center justify-between bg-yellow-500 hover:bg-yellow-600 transition duration-300 text-white rounded-xl p-5 shadow-lg">

            <div class="flex items-center gap-3">
                <span class="text-3xl">🅿️</span>

                <div>
                    <h3 class="font-semibold text-lg">
                        PayPal
                    </h3>
                    <p class="text-sm text-yellow-100">
                        Secure Online Payment
                    </p>
                </div>
            </div>

            <span class="text-xl">→</span>
        </a>
        --}}

        <!-- Secure -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                🔒 Your payment is protected with secure encryption.
            </p>
        </div>

    </div>

</body>
</html>