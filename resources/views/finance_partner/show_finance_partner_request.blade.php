<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finance Requests</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="container mx-auto px-6 py-8">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold">
                Finance Requests
            </h2>

            <p class="text-gray-500">
                {{ $partner->bank_name }}
            </p>

        </div>

        <a href="{{ route('finance.partner.dashboard') }}"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">

            Dashboard

        </a>

    </div>



    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-gray-800 text-white">

                <tr>

                    <th class="px-6 py-3 text-left">Customer</th>

                    <th class="px-6 py-3 text-left">Car</th>

                    <th class="px-6 py-3 text-left">Amount</th>

                    <th class="px-6 py-3 text-left">Status</th>

                    <th class="px-6 py-3 text-center">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($requests as $request)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-6 py-4">

                        <div class="font-semibold">
                            {{ $request->user->name }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $request->user->email }}
                        </div>

                    </td>

                    <td class="px-6 py-4">

                        {{ $request->car->carBrand->name ?? '' }}

                        {{ $request->car->model ?? '' }}

                    </td>

                    <td class="px-6 py-4">

                        ${{ number_format(($request->car->price - $request->down_payment),2) }}

                    </td>

                    <td class="px-6 py-4">

                        @if($request->status=='Approved')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                Approved

                            </span>

                        @elseif($request->status=='Rejected')

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

                        @if($request->status=='Pending')

                        <div class="flex justify-center gap-2">

                            <form action="{{ route('finance.partner.approve',$request->id) }}" method="POST">

                                @csrf

                                <button
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

                                    Approve

                                </button>

                            </form>

                            <form action="{{ route('finance.partner.reject',$request->id) }}" method="POST">

                                @csrf

                                <button
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

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

                    <td colspan="5" class="text-center py-10 text-gray-500">

                        No Finance Requests Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-5">

        {{ $requests->links() }}

    </div>

</div>

</body>
</html>