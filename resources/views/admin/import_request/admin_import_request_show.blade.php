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

                        <th class="p-3">Shipping</th>

                        <th class="p-3">Tracking</th>

                        <th class="p-3">Customs</th>

                        <th class="p-3">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($requests as $request)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">{{ $request->id }}</td>

                            <td class="p-3">{{ $request->user_id }}</td>

                            <td class="p-3">{{ $request->country }}</td>

                            <td class="p-3">{{ $request->car_name }}</td>

                            <td class="p-3">
                                {{ $request->budget }}
                            </td>

                            <td class="p-3">
                                {{ $request->notes }}
                            </td>

                            {{-- Status --}}
                            <td class="p-3">

                                <form action="{{ route('admin.import.request.update', $request->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <select name="status" class="border rounded px-3 py-2 w-full">

                                        <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>

                                        <option value="Processing"
                                            {{ $request->status == 'Processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>

                                        <option value="Rejected"
                                            {{ $request->status == 'Rejected' ? 'selected' : '' }}>
                                            Rejected
                                        </option>

                                        <option value="Completed"
                                            {{ $request->status == 'Completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>

                                        <option value="Delivered"
                                            {{ $request->status == 'Delivered' ? 'selected' : '' }}>    
                                            Delivered
                                        </option>

                                    </select>

                                    <button
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mt-2 w-full">
                                        Update
                                    </button>

                                </form>

                            </td>

                            {{-- Shipping --}}
                            <td class="p-3">

                                {{ $request->shipping_cost ?? '-' }}

                                {{ $request->currency ?? '' }}

                            </td>

                            {{-- Tracking --}}
                            <td class="p-3 text-sm">

                                <div>
                                    <strong>No:</strong>
                                    <br>
                                    {{ $request->tracking_number ?? '-' }}
                                </div>

                                <div class="mt-2">
                                    <strong>Status:</strong>
                                    <br>
                                    {{ $request->tracking_status ?? '-' }}
                                </div>

                            </td>

                            {{-- Customs --}}
                            <td class="p-3">

                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">

                                    {{ $request->customs_status ?? 'Pending' }}

                                </span>

                            </td>

                            {{-- Created --}}
                            <td class="p-3">

                                {{ $request->created_at->format('d M Y') }}

                            </td>

                            {{-- Actions --}}
                            <td class="p-3">

                                <div class="flex flex-col gap-2">

                                    {{-- Create Shipment --}}
                                    <form action="{{ route('import.shipment', $request->id) }}" method="POST">

                                        @csrf

                                        <button
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded w-full">

                                            Create Shipment

                                        </button>

                                    </form>

                                    {{-- Update Tracking --}}
                                    <a href="{{ route('import.tracking', $request->id) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded">

                                        Update Tracking

                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.import.request.delete', $request->id) }}"
                                        method="POST" onsubmit="return confirm('Delete this request?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded w-full">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="12" class="text-center p-6 text-gray-500">

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
