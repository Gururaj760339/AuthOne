<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Car</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto my-10 bg-white shadow-lg rounded-lg p-8">

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-300 bg-red-100 p-4 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-3xl font-bold mb-8">
            Add New Car
        </h2>

        <form action="{{ route('admin.cars.add') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-2 gap-6">

                <!-- Brand -->

                <div>
                    <label class="font-semibold">Brand</label>

                    <select name="brand_id" class="w-full border rounded-lg p-3 mt-2">

                        <option value="">Select Brand</option>

                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Title -->

                <div>
                    <label class="font-semibold">Car Title</label>

                    <input type="text" name="title" class="w-full border rounded-lg p-3 mt-2">
                </div>

                <!-- Price -->

                <div>
                    <label class="font-semibold">Price</label>

                    <input type="number" name="price" class="w-full border rounded-lg p-3 mt-2">
                </div>

                <!-- Year -->

                <div>
                    <label class="font-semibold">Year</label>

                    <input type="number" name="year" class="w-full border rounded-lg p-3 mt-2">
                </div>

                <!-- Fuel -->

                <div>

                    <label>Fuel Type</label>

                    <select name="fuel_type" class="w-full border rounded-lg p-3 mt-2">

                        <option>Petrol</option>
                        <option>Diesel</option>
                        <option>Hybrid</option>
                        <option>Electric</option>

                    </select>

                </div>

                <!-- Transmission -->

                <div>

                    <label>Transmission</label>

                    <select name="transmission" class="w-full border rounded-lg p-3 mt-2">

                        <option>Automatic</option>
                        <option>Manual</option>

                    </select>

                </div>

                <!-- Mileage -->

                <div>

                    <label>Mileage</label>

                    <input type="number" name="mileage" class="w-full border rounded-lg p-3 mt-2">

                </div>

                <!-- Engine -->

                <div>

                    <label>Engine</label>

                    <input type="text" name="engine" class="w-full border rounded-lg p-3 mt-2">

                </div>

                <!-- Horsepower -->

                <div>

                    <label>Horsepower</label>

                    <input type="text" name="horsepower" class="w-full border rounded-lg p-3 mt-2">

                </div>

                <!-- Color -->

                <div>

                    <label>Color</label>

                    <input type="text" name="color" class="w-full border rounded-lg p-3 mt-2">

                </div>

                <!-- Condition -->

                <div>

                    <label>Condition</label>

                    <select name="condition" class="w-full border rounded-lg p-3 mt-2">

                        <option>New</option>
                        <option>Used</option>

                    </select>

                </div>

                <!-- Status -->

                <div>

                    <label>Status</label>

                    <select name="status" class="w-full border rounded-lg p-3 mt-2">

                        <option value="1">Active</option>
                        <option value="0">Inactive</option>

                    </select>

                </div>

                <!-- Thumbnail -->

                <div class="col-span-2">

                    <label>Thumbnail</label>

                    <input type="file" name="thumbnail" class="w-full border rounded-lg p-3 mt-2">

                </div>

                <!-- Description -->

                <div class="col-span-2">

                    <label>Description</label>

                    <textarea rows="6" name="description" class="w-full border rounded-lg p-3 mt-2"></textarea>

                </div>

            </div>

            <div class="mt-8">

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                    Save Car

                </button>

            </div>

        </form>

    </div>

</body>

</html>
