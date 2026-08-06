<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Import Finance Requests</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8 px-6">

        <div class="flex justify-between mb-6">

            <div>

                <h2 class="text-3xl font-bold">

                    Import Finance Requests

                </h2>

                <p class="text-gray-500">

                    {{ $partner->bank_name }}

                </p>

            </div>

        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-800 text-white">

                    <tr>

                        <th class="px-6 py-3 text-left">Customer</th>

                        <th class="px-6 py-3 text-left">Car</th>

                        <th class="px-6 py-3 text-left">Price</th>

                        <th class="px-6 py-3 text-left">Loan</th>

                        <th class="px-6 py-3 text-left">Duration</th>

                        <th class="px-6 py-3 text-left">Status</th>

                        <th class="px-6 py-3 text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($requests as $request)
                        <tr class="border-b">

                            <td class="px-6 py-4">

                                <div class="font-semibold">

                                    {{ $request->user->name }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $request->user->email }}

                                </div>

                            </td>

                            <td class="px-6 py-4">

                                {{ $request->importRequest->car->carBrand->name ?? '' }}

                                {{ $request->importRequest->car->model ?? '' }}

                            </td>

                            <td class="px-6 py-4">

                                ${{ number_format($request->car_price, 2) }}

                            </td>

                            <td class="px-6 py-4">

                                ${{ number_format($request->loan_amount, 2) }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $request->loan_duration }} Months

                            </td>

                            <td class="px-6 py-4">

                                @if ($request->status == 'approved')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                        Approved

                                    </span>
                                @elseif($request->status == 'rejected')
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                                        Rejected

                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                        Pending

                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if ($request->status == 'pending')
                                    <div class="flex justify-center gap-2">

                                        <form action="{{ route('import.finance.partner.approve', $request->id) }}"
                                            method="POST">

                                            @csrf

                                            <button class="bg-green-600 text-white px-4 py-2 rounded">

                                                Approve

                                            </button>

                                        </form>

                                        <form action="{{ route('import.finance.partner.reject', $request->id) }}"
                                            method="POST">

                                            @csrf

                                            <button class="bg-red-600 text-white px-4 py-2 rounded">

                                                Reject

                                            </button>

                                        </form>

                                    </div>
                                @else
                                    <span class="text-gray-500">

                                        Completed

                                    </span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-10">

                                No Import Finance Requests Found.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $requests->links() }}

        </div>

    </div>

</body>

</html>
