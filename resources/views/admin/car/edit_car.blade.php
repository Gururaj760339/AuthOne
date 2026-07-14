<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car | AutoOne Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto my-10 bg-white shadow-lg rounded-lg p-8">

    <h2 class="text-3xl font-bold mb-8">
        Edit Car
    </h2>

    <form action="{{ route('admin.cars.update', $car->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            <!-- Brand -->
            <div>
                <label class="font-semibold">Brand</label>

                <select name="brand_id" class="w-full border rounded-lg p-3 mt-2">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ $car->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Title -->
            <div>
                <label class="font-semibold">Car Title</label>

                <input type="text"
                       name="title"
                       value="{{ old('title', $car->title) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Price -->
            <div>
                <label class="font-semibold">Price</label>

                <input type="number"
                       name="price"
                       value="{{ old('price', $car->price) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Year -->
            <div>
                <label class="font-semibold">Year</label>

                <input type="number"
                       name="year"
                       value="{{ old('year', $car->year) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Fuel Type -->
            <div>
                <label class="font-semibold">Fuel Type</label>

                <select name="fuel_type" class="w-full border rounded-lg p-3 mt-2">
                    <option value="Petrol" {{ $car->fuel_type=='Petrol'?'selected':'' }}>Petrol</option>
                    <option value="Diesel" {{ $car->fuel_type=='Diesel'?'selected':'' }}>Diesel</option>
                    <option value="Hybrid" {{ $car->fuel_type=='Hybrid'?'selected':'' }}>Hybrid</option>
                    <option value="Electric" {{ $car->fuel_type=='Electric'?'selected':'' }}>Electric</option>
                </select>
            </div>

            <!-- Transmission -->
            <div>
                <label class="font-semibold">Transmission</label>

                <select name="transmission" class="w-full border rounded-lg p-3 mt-2">
                    <option value="Automatic" {{ $car->transmission=='Automatic'?'selected':'' }}>Automatic</option>
                    <option value="Manual" {{ $car->transmission=='Manual'?'selected':'' }}>Manual</option>
                </select>
            </div>

            <!-- Mileage -->
            <div>
                <label class="font-semibold">Mileage</label>

                <input type="number"
                       name="mileage"
                       value="{{ old('mileage', $car->mileage) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Engine -->
            <div>
                <label class="font-semibold">Engine</label>

                <input type="text"
                       name="engine"
                       value="{{ old('engine', $car->engine) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Horsepower -->
            <div>
                <label class="font-semibold">Horsepower</label>

                <input type="text"
                       name="horsepower"
                       value="{{ old('horsepower', $car->horsepower) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Color -->
            <div>
                <label class="font-semibold">Color</label>

                <input type="text"
                       name="color"
                       value="{{ old('color', $car->color) }}"
                       class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Condition -->
            <div>
                <label class="font-semibold">Condition</label>

                <select name="condition" class="w-full border rounded-lg p-3 mt-2">
                    <option value="New" {{ $car->condition=='New'?'selected':'' }}>New</option>
                    <option value="Used" {{ $car->condition=='Used'?'selected':'' }}>Used</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="font-semibold">Status</label>

                <select name="status" class="w-full border rounded-lg p-3 mt-2">
                    <option value="1" {{ $car->status==1?'selected':'' }}>Active</option>
                    <option value="0" {{ $car->status==0?'selected':'' }}>Inactive</option>
                </select>
            </div>

            <!-- Thumbnail -->
            <div class="col-span-2">
                <label class="font-semibold">Current Thumbnail</label>

                <div class="my-3">
                    <img src="{{ asset('storage/'.$car->thumbnail) }}"
                         class="w-40 h-28 rounded-lg object-cover border">
                </div>

                <input type="file"
                       name="thumbnail"
                       class="w-full border rounded-lg p-3">
            </div>

            <!-- Description -->
            <div class="col-span-2">
                <label class="font-semibold">Description</label>

                <textarea
                    name="description"
                    rows="6"
                    class="w-full border rounded-lg p-3 mt-2">{{ old('description', $car->description) }}</textarea>
            </div>

        </div>

        <div class="mt-8 flex gap-4">

            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg">
                Update Car
            </button>

            <a href="{{ route('admin.cars') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>