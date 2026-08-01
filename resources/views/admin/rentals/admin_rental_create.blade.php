<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rental</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto py-10">

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl">

            <div class="border-b p-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold">
                    Add Rental
                </h2>

                <a href="{{ route('vendor.rental') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    Back
                </a>
            </div>

            <form action="{{ route('vendor.rental.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Car -->
                <div>
                    <label class="block font-semibold mb-2">
                        Select Car
                    </label>

                    <select name="car_id" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500">

                        <option value="">Choose Car</option>

                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
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

                    <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') }}"
                        class="w-full border rounded-lg p-3" placeholder="100">
                </div>

                <!-- Price Per Week -->
                <div>
                    <label class="block font-semibold mb-2">
                        Price Per Week
                    </label>

                    <input type="number" step="0.01" name="price_per_week" value="{{ old('price_per_week') }}"
                        class="w-full border rounded-lg p-3" placeholder="600">
                </div>

                <!-- Price Per Month -->
                <div>
                    <label class="block font-semibold mb-2">
                        Price Per Month
                    </label>

                    <input type="number" step="0.01" name="price_per_month" value="{{ old('price_per_month') }}"
                        class="w-full border rounded-lg p-3" placeholder="2000">
                </div>

                <!-- Available -->
                <div>
                    <label class="block font-semibold mb-2">
                        Availability
                    </label>

                    <select name="available" class="w-full border rounded-lg p-3">

                        <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>
                            Not Available
                        </option>

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        City
                    </label>

                    <input type="text" name="city" value="{{ old('city', $rental->city ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter city">
                </div>

                <!-- Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                        Save Rental
                    </button>
                </div>

            </form>

        </div>

    </div>

</body>

</html>
