<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars | AutoOne Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <div class="max-w-7xl mx-auto p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Cars Brand Manage
                </h1>

                <p class="text-slate-500 mt-1">
                    Manage all available cars brands.
                </p>
            </div>

            <a href="{{ route('admin.add.car.brand') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                + Add Car
            </a>

        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-900 text-white">

                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Logo</th>
                        <th class="p-4 text-left">Brand Name</th>
                        <th class="p-4 text-left">Slug</th>
                        <th class="p-4 text-left">Country</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($brands as $brand)
                        <tr class="border-b hover:bg-slate-50">

                            <td class="p-4">
                                {{ $brand->id }}
                            </td>

                            <td class="p-4">

                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                    class="w-20 h-14 object-contain rounded-lg border">

                            </td>

                            <td class="p-4 font-semibold">
                                {{ $brand->name }}
                            </td>

                            <td class="p-4 text-slate-600">
                                {{ $brand->slug }}
                            </td>

                            <td class="p-4">
                                {{ $brand->country }}
                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.edit.car.brand', $brand->id) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.car.brand.delete', $brand->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete this brand?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-8 text-gray-500">
                                No Car Brand Found.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
