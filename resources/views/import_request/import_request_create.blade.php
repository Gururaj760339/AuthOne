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

    @if(session('success'))
        <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customer.import.request.store') }}" method="POST">

        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                {{ translate('Country') }}
            </label>

            <input
                type="text"
                name="country"
                value="{{ old('country') }}"
                placeholder="Japan"
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                {{ translate('Car Name') }}
            </label>

            <input
                type="text"
                name="car_name"
                value="{{ old('car_name') }}"
                placeholder="Toyota Prius"
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                {{ translate('Budget') }}
            </label>

            <input
                type="number"
                name="budget"
                value="{{ old('budget') }}"
                placeholder="20000"
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">
                {{ translate('Notes') }}
            </label>

            <textarea
                name="notes"
                rows="5"
                placeholder="Write additional requirements..."
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
            {{ translate('Submit Import Request') }}
        </button>

    </form>

</div>

</body>
</html>