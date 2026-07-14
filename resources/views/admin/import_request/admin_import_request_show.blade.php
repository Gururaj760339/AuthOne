<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Import Requests</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-8">
            Import Requests
        </h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-auto">

            <table class="min-w-full">

                <thead class="bg-gray-800 text-white">

                    <tr>

                        <th class="p-3">ID</th>

                        <th class="p-3">User ID</th>

                        <th class="p-3">Country</th>

                        <th class="p-3">Car Name</th>

                        <th class="p-3">Budget</th>

                        <th class="p-3">Notes</th>

                        <th class="p-3">Status</th>

                        <th class="p-3">Created</th>

                        <th class="p-3">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($requests as $request)
                        <tr class="border-b">

                            <td class="p-3">
                                {{ $request->id }}
                            </td>

                            <td class="p-3">
                                {{ $request->user_id }}
                            </td>

                            <td class="p-3">
                                {{ $request->country }}
                            </td>

                            <td class="p-3">
                                {{ $request->car_name }}
                            </td>

                            <td class="p-3">
                                {{ $request->budget }}
                            </td>

                            <td class="p-3">
                                {{ $request->notes }}
                            </td>

                            <td class="p-3">

                                <form action="{{ route('admin.import.request.update', $request->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <select name="status" class="border rounded px-3 py-2">

                                        <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>

                                        <option value="Processing" {{ $request->status == 'Processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>

                                        <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }}>
                                            Rejected
                                        </option>

                                        <option value="Completed" {{ $request->status == 'Completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>

                                    </select>

                                    <button class="bg-blue-600 text-white px-4 py-2 rounded mt-2 w-full">
                                        Update
                                    </button>

                                </form>

                            </td>

                            <td class="p-3">
                                {{ $request->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3">

                                <form action="{{ route('admin.import.request.delete', $request->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this request?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-600 text-white px-4 py-2 rounded">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center p-5">
                                No Import Requests Found.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
