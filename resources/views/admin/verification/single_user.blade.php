<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto py-10">

        <div class="bg-white shadow-lg rounded-lg">

            <div class="border-b px-6 py-4">
                <h2 class="text-2xl font-bold">
                    User Verification Details
                </h2>
            </div>

            <div class="p-6">

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold">Name</label>
                        <p>{{ $verification->user->name }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Email</label>
                        <p>{{ $verification->user->email }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Phone</label>
                        <p>{{ $verification->user->phone }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">NID Number</label>
                        <p>{{ $verification->nid_number }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Driving License</label>
                        <p>{{ $verification->driving_license_number }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Status</label>

                        @if ($verification->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                Pending
                            </span>
                        @elseif($verification->status == 'approved')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                Approved
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                Rejected
                            </span>
                        @endif

                    </div>

                </div>

                <hr class="my-8">

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <h3 class="font-bold mb-2">
                            NID Front
                        </h3>

                        <img src="{{ asset('storage/' . $verification->nid_front_image) }}"
                            class="rounded border w-full">
                    </div>

                    <div>
                        <h3 class="font-bold mb-2">
                            NID Back
                        </h3>

                        <img src="{{ asset('storage/' . $verification->nid_back_image) }}"
                            class="rounded border w-full">
                    </div>

                    <div>
                        <h3 class="font-bold mb-2">
                            Driving License
                        </h3>

                        <img src="{{ asset('storage/' . $verification->driving_license_image) }}"
                            class="rounded border w-full">
                    </div>

                    @if ($verification->selfie_image)
                        <div>
                            <h3 class="font-bold mb-2">
                                Selfie
                            </h3>

                            <img src="{{ asset('storage/' . $verification->selfie_image) }}"
                                class="rounded border w-full">
                        </div>
                    @endif

                </div>

                <hr class="my-8">

                @if ($verification->status == 'pending')
                    <div class="flex justify-between items-start gap-6">

                        <form action="{{ route('admin.user.verification.approve', $verification->id) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.user.verification.reject', $verification->id) }}" method="POST"
                            class="flex items-start gap-3">

                            @csrf

                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">
                                Reject
                            </button>
                            <textarea name="admin_note" rows="3" class="border rounded-lg p-3 w-96" placeholder="Write rejection reason..."
                                required></textarea>

                        </form>

                    </div>
                @endif

            </div>

        </div>

    </div>

</body>

</html>
