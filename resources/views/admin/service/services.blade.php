<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Services</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">

        <div class="p-6 border-b flex justify-between">

            <h2 class="text-2xl font-bold">
                Manage Services
            </h2>

            <a href="{{ route('admin.service.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                Add Service
            </a>

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

                    <th class="p-3">Status</th>

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

                            <img
                                src="{{ asset('storage/'.$service->image) }}"
                                class="w-20 h-16 rounded object-cover">

                        </td>

                        <td class="p-3">
                            {{ $service->category->name ?? '-' }}
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

                        <td class="p-3">

                            <form
                                action="{{ route('admin.service.update',$service->id) }}"
                                method="POST"
                                class="flex gap-2">

                                @csrf

                                <select
                                    name="status"
                                    class="border rounded px-3 py-2">

                                    <option
                                        value="1"
                                        {{ $service->status=='active' ? 'selected':'' }}>
                                        Active
                                    </option>

                                    <option
                                        value="0"
                                        {{ $service->status=='inactive' ? 'selected':'' }}>
                                        Inactive
                                    </option>

                                </select>

                                <button
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 rounded">

                                    Update

                                </button>

                            </form>

                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">
                                <form
                                    action="{{ route('admin.service.delete',$service->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this service?')"
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