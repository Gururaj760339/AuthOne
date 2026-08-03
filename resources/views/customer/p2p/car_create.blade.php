<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Add Your Car') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10 px-4">

    <div class="bg-white shadow-lg rounded-lg">

        <div class="border-b px-6 py-4">
            <h2 class="text-2xl font-bold">{{ translate('Add Your Car') }}</h2>
            <p class="text-gray-500">
                {{ translate('Submit your car for approval.') }}
            </p>
        </div>

        <div class="p-6">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-5">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('p2p.cars.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Brand') }}
                        </label>

                        <input type="text"
                               name="brand"
                               value="{{ old('brand') }}"
                               class="w-full border rounded-lg p-3"
                               placeholder="Toyota">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Model') }}
                        </label>

                        <input type="text"
                               name="model"
                               value="{{ old('model') }}"
                               class="w-full border rounded-lg p-3"
                               placeholder="Corolla">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Year') }}
                        </label>

                        <input type="number"
                               name="year"
                               value="{{ old('year') }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Registration Number') }}
                        </label>

                        <input type="text"
                               name="registration_no"
                               value="{{ old('registration_no') }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Color') }}
                        </label>

                        <input type="text"
                               name="color"
                               value="{{ old('color') }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Fuel Type') }}
                        </label>

                        <select name="fuel_type"
                                class="w-full border rounded-lg p-3">

                            <option value="">{{
                                translate('Select Fuel') }}</option>
                            <option value="Petrol">{{ translate('Petrol') }}</option>
                            <option value="Diesel">{{ translate('Diesel') }}</option>
                            <option value="Hybrid">{{ translate('Hybrid') }}</option>
                            <option value="Electric">{{ translate('Electric') }}</option>

                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Seats') }}
                        </label>

                        <input type="number"
                               name="seats"
                               value="{{ old('seats',5) }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            {{ translate('Price Per Day ($)') }}
                        </label>

                        <input type="number"
                               step="0.01"
                               name="price_per_day"
                               value="{{ old('price_per_day') }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                </div>

                <div class="mt-5">

                    <label class="block font-semibold mb-2">
                        {{ translate('Description') }}
                    </label>

                    <textarea name="description"
                              rows="5"
                              class="w-full border rounded-lg p-3">{{ old('description') }}</textarea>

                </div>

                <div class="mt-5">

                    <label class="block font-semibold mb-2">
                        {{ translate('Car Image') }}
                    </label>

                    <input type="file"
                           name="main_image"
                           class="w-full border rounded-lg p-3">

                </div>

                <div class="mt-8 flex justify-between">

                    <a href="{{ route('p2p.cars.show') }}"
                       class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
                        Back
                    </a>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        {{ translate('Submit Car') }}
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>