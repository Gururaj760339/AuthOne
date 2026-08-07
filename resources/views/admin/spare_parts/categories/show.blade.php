<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Part Categories</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Spare Part Categories
            </h1>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add Category -->
        <div class="bg-white rounded-xl shadow mb-8">

            <div class="border-b px-6 py-4">
                <h2 class="text-xl font-semibold">
                    Add New Category
                </h2>
            </div>

            <div class="p-6">

                <form action="{{ route('admin.spare.categories.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">

                    @csrf

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Category Name
                        </label>

                        <input type="text" name="name"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="Enter category name" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Description
                        </label>

                        <textarea name="description" rows="4"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="Write description..."></textarea>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Image
                        </label>

                        <input type="file" name="image" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Add Category
                    </button>

                </form>

            </div>

        </div>

        <!-- Category List -->
        <div class="bg-white rounded-xl shadow">

            <div class="border-b px-6 py-4">
                <h2 class="text-xl font-semibold">
                    Category List
                </h2>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Description</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)
                            <tr class="border-t hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3">

                                    @if ($category->image)
                                        <img src="{{ asset('uploads/spare_categories/' . $category->image) }}"
                                            class="w-16 h-16 rounded-lg object-cover">
                                    @else
                                        <span class="text-gray-400">
                                            No Image
                                        </span>
                                    @endif

                                </td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $category->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $category->description }}
                                </td>

                                <td class="px-4 py-3">

                                    @if ($category->status == 'Active')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Active
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Inactive
                                        </span>
                                    @endif

                                </td>

                                <td class="px-4 py-3 text-center">

                                    <form action="{{ route('admin.spare.categories.destroy', $category->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete this category?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    No Categories Found
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-6">
                {{ $categories->links() }}
            </div>

        </div>

    </div>

</body>

</html>
