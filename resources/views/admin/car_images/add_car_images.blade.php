<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Image</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10">

    <div class="bg-white shadow-lg rounded-lg p-8">

        <h2 class="text-2xl font-bold mb-6">
            Add Car Image
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-5">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cars.image.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- Select Car -->
            <div class="mb-5">
                <label class="block mb-2 font-semibold">
                    Select Car
                </label>

                <select
                    name="car_id"
                    class="w-full border rounded-lg p-3">

                    <option value="">-- Select Car --</option>

                    @foreach($cars as $car)
                        <option
                            value="{{ $car->id }}"
                            {{ old('car_id') == $car->id ? 'selected' : '' }}>
                            {{ $car->title }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Select Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="w-full border rounded-lg p-3">
            </div>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                Upload Image

            </button>

        </form>

    </div>

</div>

</body>
</html>