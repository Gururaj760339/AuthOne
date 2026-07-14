<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold">
                Edit Car Brand
            </h1>

            <p class="text-gray-500">
                Update Brand Information
            </p>
        </div>

        <a href="{{ route('admin.car.brand.show') }}"
            class="bg-gray-700 text-white px-5 py-3 rounded-xl">
            Back
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-8">

        <form
            action="{{ route('admin.car.brand.update',$brand->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- ID -->

            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    ID
                </label>

                <input
                    type="text" readonly
                    value="{{ $brand->id }}"
                    readonly
                    class="w-full border rounded-xl px-4 py-3 bg-gray-100">

            </div>

            <!-- Name -->

            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    Brand Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$brand->name) }}"
                    class="w-full border rounded-xl px-4 py-3">

                @error('name')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Country -->

            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    Country
                </label>

                <input
                    type="text"
                    name="country"
                    value="{{ old('country',$brand->country) }}"
                    class="w-full border rounded-xl px-4 py-3">

                @error('country')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Slug -->

            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    Slug
                </label>

                <input
                    type="text"
                    value="{{ $brand->slug }}"
                    readonly
                    class="w-full border rounded-xl px-4 py-3 bg-gray-100">

            </div>

            <!-- Current Logo -->

            <div class="mb-5">

                <label class="font-semibold block mb-3">
                    Current Logo
                </label>

                <img
                    src="{{ asset($brand->logo) }}"
                    class="w-40 h-40 object-contain border rounded-lg">

            </div>

            <!-- Upload -->

            <div class="mb-8">

                <label class="font-semibold block mb-2">
                    Upload New Logo
                </label>

                <input
                    type="file"
                    name="logo"
                    class="w-full border rounded-xl px-4 py-3">

                @error('logo')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl">

                Update Brand

            </button>

        </form>

    </div>

</div>

</body>
</html>