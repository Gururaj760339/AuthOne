<!DOCTYPE html>
<html>

<head>
    <title>More Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-lg mx-auto mt-20 bg-white p-8 rounded-lg shadow text-center">

        <h2 class="text-2xl font-bold mb-4">
            Booking Added Successfully
        </h2>

        <p class="mb-8">
            Do you want to add another service?
        </p>

        <div class="flex justify-center gap-4">

            <a href="{{ route('customer.carwash') }}" class="bg-blue-600 text-white px-6 py-3 rounded">
                Yes, Add More
            </a>

            <form action="{{ route('booking.finish') }}" method="POST">
                @csrf
                <button class="bg-green-600 text-white px-6 py-3 rounded">
                    No, Proceed to Checkout
                </button>
            </form>

        </div>

    </div>

</body>

</html>
