<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rental</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto py-10">

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-5">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg">

        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold">
                Edit Rental
            </h2>

            <a href="{{ route('admin.rental') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                Back
            </a>
        </div>

        <form action="{{ route('admin.rental.update', $rental->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Car -->
            <div>
                <label class="block font-semibold mb-2">
                    Select Car
                </label>

                <select name="car_id" class="w-full border rounded-lg p-3">

                    @foreach($cars as $car)
                        <option value="{{ $car->id }}"
                            {{ old('car_id', $rental->car_id) == $car->id ? 'selected' : '' }}>
                            {{ $car->title }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Price Per Day -->
            <div>
                <label class="block font-semibold mb-2">
                    Price Per Day
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price_per_day"
                    value="{{ old('price_per_day', $rental->price_per_day) }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <!-- Price Per Week -->
            <div>
                <label class="block font-semibold mb-2">
                    Price Per Week
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price_per_week"
                    value="{{ old('price_per_week', $rental->price_per_week) }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <!-- Price Per Month -->
            <div>
                <label class="block font-semibold mb-2">
                    Price Per Month
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price_per_month"
                    value="{{ old('price_per_month', $rental->price_per_month) }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <!-- Available -->
            <div>
                <label class="block font-semibold mb-2">
                    Availability
                </label>

                <select name="available" class="w-full border rounded-lg p-3">

                    <option value="1"
                        {{ old('available', $rental->available) == 1 ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="0"
                        {{ old('available', $rental->available) == 0 ? 'selected' : '' }}>
                        Not Available
                    </option>

                </select>
            </div>

            <div class="flex gap-4">

                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                    Update Rental
                </button>

                <a href="{{ route('admin.rental') }}"
                   class="flex-1 text-center bg-gray-500 hover:bg-gray-600 text-white py-3 rounded-lg font-semibold">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>