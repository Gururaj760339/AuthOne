<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Rental Booking') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto py-12 px-4">

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-xl">

        <div class="border-b p-6">
            <h2 class="text-3xl font-bold">
                {{ translate('Rental Booking') }}
            </h2>
            <p class="text-gray-500 mt-2">
                {{ translate('Fill in the booking details below.') }}
            </p>
        </div>

        <form action="{{ route('customer.rental.booking.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <input type="hidden"
                   name="rental_id"
                   value="{{ $rental->id }}">

            <div>
                <label class="block font-semibold mb-2">
                    {{ translate('Pickup Date') }}
                </label>

                <input
                    type="date"
                    name="pickup_date"
                    min="{{ date('Y-m-d') }}"
                    value="{{ old('pickup_date') }}"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    {{ translate('Return Date') }}
                </label>

                <input
                    type="date"
                    name="return_date"
                    min="{{ date('Y-m-d') }}"
                    value="{{ old('return_date') }}"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                {{ translate('Book Now') }}
            </button>

        </form>

    </div>

</div>

</body>
</html>