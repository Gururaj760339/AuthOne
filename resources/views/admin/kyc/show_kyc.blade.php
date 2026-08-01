<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KYC Details</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-5">

    <div class="bg-white shadow-lg rounded-xl p-8">

        <div class="flex justify-between items-center mb-8">

            <h2 class="text-3xl font-bold">
                KYC Details
            </h2>

            <a href="{{ route('admin.kycs.show') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

                Back

            </a>

        </div>

        @if(session('success'))

            <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">

                {{ session('success') }}

            </div>

        @endif

        {{-- User Information --}}

        <div class="grid md:grid-cols-2 gap-6 mb-8">

            <div class="border rounded-lg p-5">

                <h3 class="font-bold text-xl mb-4">
                    User Information
                </h3>

                <p><strong>Name :</strong> {{ $kyc->user->name }}</p>

                <p class="mt-2"><strong>Email :</strong> {{ $kyc->user->email }}</p>

                <p class="mt-2"><strong>Status :</strong>

                    @if($kyc->status=='pending')

                        <span class="text-yellow-600 font-semibold">
                            Pending
                        </span>

                    @elseif($kyc->status=='verified')

                        <span class="text-green-600 font-semibold">
                            Verified
                        </span>

                    @else

                        <span class="text-red-600 font-semibold">
                            Rejected
                        </span>

                    @endif

                </p>

                <p class="mt-2">

                    <strong>Submitted :</strong>

                    {{ $kyc->created_at->format('d M Y h:i A') }}

                </p>

            </div>

        </div>

        {{-- Documents --}}

        <div class="grid md:grid-cols-2 gap-8">

            <div>

                <h4 class="font-bold mb-3">

                    Driver License Front

                </h4>

                <img src="{{ asset('storage/'.$kyc->driver_license_front) }}"
                    class="rounded-lg border w-full h-72 object-cover">

            </div>

            <div>

                <h4 class="font-bold mb-3">

                    Driver License Back

                </h4>

                <img src="{{ asset('storage/'.$kyc->driver_license_back) }}"
                    class="rounded-lg border w-full h-72 object-cover">

            </div>

            <div>

                <h4 class="font-bold mb-3">

                    National ID

                </h4>

                @if($kyc->national_id)

                    <a href="{{ asset('storage/'.$kyc->national_id) }}"
                        target="_blank"
                        class="text-blue-600 underline">

                        View National ID

                    </a>

                @else

                    <span class="text-gray-500">
                        Not Uploaded
                    </span>

                @endif

            </div>

            <div>

                <h4 class="font-bold mb-3">

                    Passport

                </h4>

                @if($kyc->passport)

                    <a href="{{ asset('storage/'.$kyc->passport) }}"
                        target="_blank"
                        class="text-blue-600 underline">

                        View Passport

                    </a>

                @else

                    <span class="text-gray-500">
                        Not Uploaded
                    </span>

                @endif

            </div>

            <div class="md:col-span-2">

                <h4 class="font-bold mb-3">

                    Selfie

                </h4>

                @if($kyc->selfie)

                    <img src="{{ asset('storage/'.$kyc->selfie) }}"
                        class="rounded-lg border w-64">

                @else

                    <span class="text-gray-500">

                        Not Uploaded

                    </span>

                @endif

            </div>

        </div>

        {{-- Approve / Reject --}}

        @if($kyc->status=='pending')

        <div class="mt-10 border-t pt-8">

            <div class="flex gap-4">

                {{-- Approve --}}

                <form action="{{ route('admin.kyc.approve',$kyc->id) }}"
                    method="POST">

                    @csrf

                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

                        Approve

                    </button>

                </form>

            </div>

            {{-- Reject Form --}}

            <form action="{{ route('admin.kyc.reject',$kyc->id) }}"
                method="POST"
                class="mt-6">

                @csrf

                <label class="font-semibold">

                    Rejection Reason

                </label>

                <textarea
                    name="rejection_reason"
                    rows="4"
                    required
                    class="w-full border rounded-lg p-3 mt-2"
                    placeholder="Enter rejection reason..."></textarea>

                <button
                    class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">

                    Reject

                </button>

            </form>

        </div>

        @endif

        @if($kyc->status=='rejected')

            <div class="mt-8 bg-red-100 border border-red-300 p-4 rounded-lg">

                <strong>Reason :</strong>

                {{ $kyc->rejection_reason }}

            </div>

        @endif

    </div>

</div>

</body>

</html>