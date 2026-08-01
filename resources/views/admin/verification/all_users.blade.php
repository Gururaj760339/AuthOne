<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Verifications</title>
    <script src="https://cdn.tailwindcss.com"></script>    
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    <div class="bg-white shadow-lg rounded-lg">

        <div class="px-6 py-4 border-b">
            <h2 class="text-2xl font-bold">
                User Verification Requests
            </h2>
        </div>

        @if(session('success'))
            <div class="m-5 bg-green-100 border border-green-400 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">NID</th>
                    <th class="px-4 py-3 text-left">License</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>

                </thead>

                <tbody>

                @forelse($verifications as $verification)

                    <tr class="border-b">

                        <td class="px-4 py-3">
                            {{ $verification->id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $verification->user->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $verification->user->email }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $verification->nid_number }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $verification->driving_license_number }}
                        </td>

                        <td class="px-4 py-3">

                            @if($verification->status=='pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                    Pending
                                </span>
                            @elseif($verification->status=='approved')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                    Approved
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                    Rejected
                                </span>
                            @endif

                        </td>

                        <td class="px-4 py-3 text-center">

                            <a href="{{ route('admin.single.user.verification',$verification->id) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded">
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-8">

                            No Verification Requests

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