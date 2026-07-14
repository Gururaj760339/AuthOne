<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service Category</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto py-10">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b">

            <h2 class="text-2xl font-bold text-gray-700">
                Edit Service Category
            </h2>

            <a href="{{ route('admin.service.category') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg transition">
                Back
            </a>

        </div>

        <!-- Validation Errors -->
        @if ($errors->any())

            <div class="mx-6 mt-6 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Form -->
        <form action="{{ route('admin.service.category.update', $category->id) }}" method="POST" class="p-6">

            @csrf

            <!-- Category Name -->
            <div class="mb-5">

                <label class="block text-gray-700 font-semibold mb-2">
                    Category Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    placeholder="Enter Category Name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Icon -->
            <div class="mb-5">

                <label class="block text-gray-700 font-semibold mb-2">
                    Font Awesome Icon
                </label>

                <input
                    type="text"
                    name="icon"
                    value="{{ old('icon', $category->icon) }}"
                    placeholder="fa-solid fa-car"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                <p class="text-sm text-gray-500 mt-2">
                    Example:
                    <span class="font-medium">fa-solid fa-car</span>,
                    <span class="font-medium">fa-solid fa-truck</span>,
                    <span class="font-medium">fa-solid fa-motorcycle</span>
                </p>

            </div>

            <!-- Icon Preview -->
            <div class="mb-6">

                <label class="block text-gray-700 font-semibold mb-2">
                    Icon Preview
                </label>

                <div class="border rounded-lg p-6 text-center">

                    <i id="previewIcon"
                       class="{{ old('icon', $category->icon) }} text-5xl text-blue-600"></i>

                </div>

            </div>

            <!-- Buttons -->
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">

                    <i class="fa-solid fa-pen-to-square mr-2"></i>

                    Update Category

                </button>

                <a href="{{ route('admin.service.category') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

<script>

const iconInput = document.querySelector('input[name="icon"]');
const preview = document.getElementById('previewIcon');

iconInput.addEventListener('input', function () {

    preview.className = this.value + " text-5xl text-blue-600";

});

</script>

</body>
</html>