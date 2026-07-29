<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Finance Requests</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        <div class="bg-white rounded-xl shadow-lg">

            <div class="flex justify-between items-center p-6 border-b">
                <h2 class="text-3xl font-bold">
                    Finance Requests
                </h2>
            </div>

            @if (session('success'))
                <div class="mx-6 mt-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-100">

                        <tr class="text-left">

                            <th class="p-4">#</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Car</th>
                            <th class="p-4">Phone</th>
                            <th class="p-4">Salary</th>
                            <th class="p-4">Employment</th>
                            <th class="p-4">Down Payment</th>

                            <th class="p-4">Status</th>

                            <th class="p-4">Created</th>
                            @if (Auth::user()->role === 'admin')
                                <th class="p-4 text-center">Action</th>
                            @endif

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($financeRequests as $request)
                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-4">
                                    <div class="font-semibold">
                                        {{ $request->full_name }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $request->email }}
                                    </div>
                                </td>

                                <td class="p-4">
                                    {{ $request->car->title ?? 'N/A' }}
                                </td>

                                <td class="p-4">
                                    {{ $request->phone }}
                                </td>

                                <td class="p-4">
                                    ${{ number_format($request->salary, 2) }}
                                </td>

                                <td class="p-4">
                                    {{ ucfirst($request->employment) }}
                                </td>

                                <td class="p-4">
                                    ${{ number_format($request->down_payment, 2) }}
                                </td>

                                <td class="p-4">

                                    <form action="{{ route('admin.finance.request.update', $request->id) }}"
                                        method="POST" class="flex gap-2">

                                        @csrf
                                        @method('PUT')

                                        <select name="status" class="border rounded-lg px-3 py-2">

                                            <option value="pending" @selected($request->status == 'Pending')>
                                                Pending
                                            </option>

                                            <option value="approved" @selected($request->status == 'Approved')>
                                                Approved
                                            </option>

                                            <option value="rejected" @selected($request->status == 'Rejected')>
                                                Rejected
                                            </option>

                                        </select>

                                        <button class="bg-blue-600 text-white px-4 rounded hover:bg-blue-700">
                                            Update
                                        </button>

                                    </form>

                                </td>

                                <td class="p-4">
                                    {{ $request->created_at->format('d M Y') }}
                                </td>

                                @if (Auth::user()->role === 'admin')
                                    <td class="p-4">

                                        <form action="{{ route('admin.finance.request.delete', $request->id) }}"
                                            method="POST" onsubmit="return confirm('Delete this request?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                Delete
                                            </button>

                                        </form>

                                    </td>
                                @endif

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="text-center py-10 text-gray-500">
                                    No Finance Requests Found
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
