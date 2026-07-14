<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Service Categories</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        <div class="bg-white rounded-lg shadow">

            <div class="flex justify-between items-center p-6 border-b">

                <h2 class="text-2xl font-bold">
                    Service Categories
                </h2>

                <a href="{{ route('admin.service.category.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    + Add Category
                </a>

            </div>

            @if (session('success'))
                <div class="m-5 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4 text-left">Icon</th>
                        <th class="p-4 text-left">Name</th>
                        <th class="p-4 text-left">Slug</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $key => $category)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">{{ $key + 1 }}</td>

                            <td class="p-4">
                                <i class="{{ $category->icon }}"></i>
                                {{ $category->icon }}
                            </td>

                            <td class="p-4">{{ $category->name }}</td>

                            <td class="p-4">{{ $category->slug }}</td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.service.category.edit', $category->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.service.category.destroy', $category->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete this category?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-10">
                                No Categories Found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
