<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Import Request') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">

        <h2 class="text-3xl font-bold text-center mb-8">
            {{ translate('Car Import Request') }}
        </h2>

        @if (session('success'))
            <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.import.request.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block font-semibold mb-2">Country</label>
                <input type="text" name="country" value="{{ old('country') }}" class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">Car</label>

                <select name="car_id" class="w-full border rounded-lg p-3" required>

                    <option value="">Select Car</option>

                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>

                            {{ $car->title }}
                            ({{ number_format($car->price, 2) }})
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Down Payment
                </label>

                <input type="number" name="down_payment" value="{{ old('down_payment') }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Notes
                </label>

                <textarea name="notes" class="w-full border rounded-lg p-3">{{ old('notes') }}</textarea>
            </div>

            <button class="bg-blue-600 text-white px-5 py-3 rounded">

                Submit

            </button>

        </form>

    </div>

</body>

</html>
