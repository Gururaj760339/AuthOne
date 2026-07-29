<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Services</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow">

            <div class="p-6 border-b flex justify-between">

                <h2 class="text-2xl font-bold">
                    Manage Services
                </h2>
                @if (Auth::check() && Auth::user()->vendor)
                    <a href="{{ route('vendor.service.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                        Add Service
                    </a>
                @endif

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="p-3">ID</th>

                            <th class="p-3">Image</th>

                            <th class="p-3">Category</th>

                            <th class="p-3">Title</th>

                            <th class="p-3">Slug</th>

                            <th class="p-3">Price</th>

                            <th class="p-3">Duration</th>
                            @if (Auth::check() && Auth::user()->role === 'admin')
                                <th class="p-3">Status</th>
                            @endif
                            <th class="p-3">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($services as $service)
                            <tr class="border-b">

                                <td class="p-3">
                                    {{ $service->id }}
                                </td>

                                <td class="p-3">

                                    <img src="{{ asset('storage/' . $service->image) }}"
                                        class="w-20 h-16 rounded object-cover">

                                </td>

                                <td class="p-3">
                                    {{ $service->serviceCategory->name ?? '-' }}
                                </td>

                                <td class="p-3">
                                    {{ $service->title }}
                                </td>

                                <td class="p-3">
                                    {{ $service->slug }}
                                </td>

                                <td class="p-3">
                                    {{ $service->price }}
                                </td>

                                <td class="p-3">
                                    {{ $service->duration }}
                                </td>

                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <td class="p-3">

                                        <form action="{{ route('admin.vendor.service.update', $service->id) }}"
                                            method="POST" class="flex gap-2">
                                            @method('PUT')
                                            @csrf

                                            <select name="status" class="border rounded px-3 py-2">
                                                <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>

                                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 rounded">

                                                Update

                                            </button>

                                        </form>

                                    </td>
                                @endif

                                <td class="p-3">

                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.vendor.service.delete', $service->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Delete this service?')"
                                                class="bg-red-600 text-white px-4 py-2 rounded">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center p-8">

                                    No Service Found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>
