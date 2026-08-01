<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        KYC Verification List
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-5">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-8">

            <h2 class="text-3xl font-bold">
                KYC Verification Requests
            </h2>

            <a href="{{ url()->previous() }}"
                class="bg-gray-700 text-white px-5 py-2 rounded-lg hover:bg-gray-800">

                Back

            </a>

        </div>

        @if(session('success'))

            <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">

                {{ session('success') }}

            </div>

        @endif

        <div class="overflow-x-auto">

            <table class="min-w-full border border-gray-300">

                <thead class="bg-gray-200">

                <tr>

                    <th class="border px-4 py-3">#</th>

                    <th class="border px-4 py-3">User</th>

                    <th class="border px-4 py-3">Email</th>

                    <th class="border px-4 py-3">Status</th>

                    <th class="border px-4 py-3">Submitted</th>

                    <th class="border px-4 py-3">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($kycs as $kyc)

                    <tr class="hover:bg-gray-50">

                        <td class="border px-4 py-3">

                            {{ $loop->iteration }}

                        </td>

                        <td class="border px-4 py-3">

                            {{ $kyc->user->name }}

                        </td>

                        <td class="border px-4 py-3">

                            {{ $kyc->user->email }}

                        </td>

                        <td class="border px-4 py-3">

                            @if($kyc->status=='pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">

                                    Pending

                                </span>

                            @elseif($kyc->status=='verified')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded">

                                    Verified

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded">

                                    Rejected

                                </span>

                            @endif

                        </td>

                        <td class="border px-4 py-3">

                            {{ $kyc->created_at->format('d M Y') }}

                        </td>

                        <td class="border px-4 py-3">

                            <a href="{{ route('admin.kyc.show',$kyc->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                                View

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-6">

                            No KYC Requests Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $kycs->links() }}

        </div>

    </div>

</div>

</body>

</html>