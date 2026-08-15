<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Fuel Requests | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-10">

        <div
            class="flex flex-col md:flex-row
                md:items-center md:justify-between
                gap-4 mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    My Fuel Requests
                </h1>

                <p class="text-gray-500">
                    Track your fuel delivery requests.
                </p>

            </div>


            <a href="{{ route('fuel.delivery.create') }}"
                class="bg-red-600 hover:bg-red-700
                   text-white px-5 py-3
                   rounded-lg text-center">
                + New Fuel Request
            </a>

        </div>


        @if (session('success'))
            <div class="bg-green-100 text-green-700
                    p-4 rounded-lg mb-6">

                {{ session('success') }}

            </div>
        @endif


        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4">
                                #
                            </th>

                            <th class="px-6 py-4">
                                Fuel
                            </th>

                            <th class="px-6 py-4">
                                Quantity
                            </th>

                            <th class="px-6 py-4">
                                Total
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4">
                                Date
                            </th>

                            <th class="px-6 py-4">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($requests as $request)
                            <tr>

                                <td class="px-6 py-4">
                                    #{{ $request->id }}
                                </td>

                                <td class="px-6 py-4 font-medium">
                                    {{ strtoupper(str_replace('_', ' ', $request->fuel_type)) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $request->requested_quantity }} L
                                </td>

                                <td class="px-6 py-4">
                                    AED
                                    {{ number_format($request->total_amount, 2) }}
                                </td>

                                <td class="px-6 py-4">

                                    <span
                                        class="px-3 py-1 rounded-full
                                    text-xs font-semibold
                                    bg-gray-100">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>

                                </td>

                                <td class="px-6 py-4 text-gray-500">

                                    {{ $request->created_at->format('d M Y') }}

                                </td>

                                <td class="px-6 py-4">

                                    <a href="{{ route('fuel.delivery.show', $request->id) }}"
                                        class="text-red-600
                                           font-semibold
                                           hover:underline">
                                        View
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="px-6 py-12
                                       text-center
                                       text-gray-500">
                                    No fuel delivery requests found.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <div class="mt-6">
            {{ $requests->links() }}
        </div>

    </div>

</body>

</html>
