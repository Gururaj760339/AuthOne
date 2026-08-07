<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Spare Part</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto py-10">

        <div class="bg-white rounded-xl shadow-lg p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    Add Spare Part
                </h1>

                <a href="{{ route('vendor.spare-parts.index') }}"
                    class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg">
                    All Parts
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-6">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('vendor.spare-parts.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block font-semibold mb-2">
                            Part Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Category
                        </label>

                        <select name="category_id" class="w-full border rounded-lg p-3">

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Brand
                        </label>

                        <input type="text" name="brand" value="{{ old('brand') }}"
                            class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Model
                        </label>

                        <input type="text" name="model" value="{{ old('model') }}"
                            class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Part Number
                        </label>

                        <input type="text" name="part_number" value="{{ old('part_number') }}"
                            class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Country
                        </label>

                        <input type="text" name="country" value="{{ old('country') }}"
                            class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Price
                        </label>

                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                            class="w-full border rounded-lg p-3" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Stock
                        </label>

                        <input type="number" name="stock" value="{{ old('stock') }}"
                            class="w-full border rounded-lg p-3" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Unit
                        </label>

                        <input type="text" name="unit" value="Piece" class="w-full border rounded-lg p-3">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select name="status" class="w-full border rounded-lg p-3">

                            <option value="Available">Available</option>
                            <option value="Out of Stock">Out of Stock</option>
                            <option value="Inactive">Inactive</option>

                        </select>
                    </div>

                    <div class="md:col-span-2">

                        <label class="block font-semibold mb-2">
                            Description
                        </label>

                        <textarea name="description" rows="5" class="w-full border rounded-lg p-3">{{ old('description') }}</textarea>

                    </div>

                    <div class="md:col-span-2">

                        <label class="block font-semibold mb-2">
                            Image
                        </label>

                        <input type="file" name="image" class="w-full border rounded-lg p-3">

                    </div>

                    <div class="md:col-span-2">

                        <label class="inline-flex items-center">

                            <input type="checkbox" name="featured" value="1" class="mr-3">

                            <span class="font-semibold">
                                Featured Product
                            </span>

                        </label>

                    </div>

                </div>

                <div class="mt-8">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                        Save Spare Part

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
