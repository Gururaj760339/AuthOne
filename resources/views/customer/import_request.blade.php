<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Import Requests</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-4">

        <div class="bg-white rounded-xl shadow-lg">

            <div class="flex items-center justify-between p-6 border-b">

                <h1 class="text-2xl font-bold text-gray-800">
                    🚗 My Import Requests
                </h1>

                <a href="{{ url()->previous() }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Back
                </a>

            </div>

            @if(session('success'))
                <div class="m-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="px-6 py-3 text-left">#</th>

                            <th class="px-6 py-3 text-left">Car Name</th>

                            <th class="px-6 py-3 text-left">Country</th>

                            <th class="px-6 py-3 text-left">Budget</th>

                            <th class="px-6 py-3 text-left">Notes</th>

                            <th class="px-6 py-3 text-left">Status</th>

                            <th class="px-6 py-3 text-left">Request Date</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($importRequests as $request)

                            <tr class="border-b hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    {{ $request->car_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $request->country }}
                                </td>

                                <td class="px-6 py-4">
                                    ${{ number_format($request->budget,2) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $request->notes ?? '-' }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($request->status=='Pending')

                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                            Pending
                                        </span>

                                    @elseif($request->status=='Processing')

                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                            Processing
                                        </span>

                                    @elseif($request->status=='Completed')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Completed
                                        </span>

                                    @elseif($request->status=='Rejected')

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Rejected
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4">
                                    {{ $request->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-10 text-gray-500">

                                    No Import Requests Found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-6">
                {{ $importRequests->links() }}
            </div>

        </div>

    </div>

</body>

</html>