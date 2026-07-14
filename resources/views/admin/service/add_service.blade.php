<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white rounded-lg shadow-lg">

        <div class="border-b p-6">
            <h2 class="text-2xl font-bold">
                Add New Service
            </h2>
        </div>

        <form
            action="{{ route('admin.service.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6 space-y-6">

            @csrf

            @if ($errors->any())

                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded">

                    <ul class="list-disc ml-5">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div>

                <label class="block mb-2 font-semibold">
                    Service Category
                </label>

                <select
                    name="service_category_id"
                    class="w-full border rounded-lg p-3">

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('service_category_id')==$category->id ? 'selected':'' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="block mb-2 font-semibold">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 font-semibold">
                        Price
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        value="{{ old('price') }}"
                        class="w-full border rounded-lg p-3">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Duration
                    </label>

                    <input
                        type="text"
                        name="duration"
                        placeholder="30 Minutes"
                        value="{{ old('duration') }}"
                        class="w-full border rounded-lg p-3">

                </div>

            </div>

            <div>

                <label class="block mb-2 font-semibold">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    class="w-full border rounded-lg p-3">{{ old('description') }}</textarea>

            </div>

            <div>

                <label class="block mb-2 font-semibold">
                    Service Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label class="block mb-2 font-semibold">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg p-3">

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                    Save Service

                </button>

                <a
                    href="{{ route('admin.service') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-lg">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>