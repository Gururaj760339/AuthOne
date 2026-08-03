<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ translate('My KYC') }}
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto py-10 px-5">

        <div class="bg-white rounded-xl shadow-lg p-8">

            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">

                <h2 class="text-3xl font-bold">
                    {{ translate('My KYC Verification') }}
                </h2>

                <div class="mt-8 flex gap-4">

                    <a href="{{ url()->previous() }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">
                        ← {{ translate('Back') }}
                    </a>

                    @if ($kyc->status != 'verified')
                        <form action="{{ route('customer.kyc.destroy') }}" method="POST"
                            onsubmit="return confirm( '{{ translate('Are you sure you want to delete your KYC? This action cannot be undone.') }}');">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">
                                🗑 {{ translate('Delete KYC') }}
                            </button>

                        </form>
                    @endif

                </div>

            </div>

            {{-- Status --}}

            <div class="mb-8">

                <h3 class="text-xl font-semibold mb-3">

                    {{ translate('Verification Status') }}

                </h3>

                @if ($kyc->status == 'pending')
                    <span class="bg-yellow-100 text-yellow-700 px-5 py-2 rounded-lg font-semibold">

                        {{ translate('Pending Review') }}

                    </span>
                @elseif($kyc->status == 'verified')
                    <span class="bg-green-100 text-green-700 px-5 py-2 rounded-lg font-semibold">

                        {{ translate('Verified') }}

                    </span>
                @else
                    <span class="bg-red-100 text-red-700 px-5 py-2 rounded-lg font-semibold">

                        {{ translate('Rejected') }}

                    </span>
                @endif

            </div>

            @if ($kyc->status == 'rejected')
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-8">

                    <strong>

                        {{ translate('Rejection Reason') }} :

                    </strong>

                    {{ translate($kyc->rejection_reason) }}

                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-8">

                {{-- Driver License Front --}}

                <div class="border rounded-lg p-5">

                    <h4 class="font-bold mb-4">

                        {{ translate('Driver License Front') }}

                    </h4>

                    <img src="{{ asset('storage/' . $kyc->driver_license_front) }}"
                        class="w-full h-72 object-cover rounded-lg border">

                </div>

                {{-- Driver License Back --}}

                <div class="border rounded-lg p-5">

                    <h4 class="font-bold mb-4">

                        {{ translate('Driver License Back') }}

                    </h4>

                    <img src="{{ asset('storage/' . $kyc->driver_license_back) }}"
                        class="w-full h-72 object-cover rounded-lg border">

                </div>

                {{-- National ID --}}

                <div class="border rounded-lg p-5">

                    <h4 class="font-bold mb-4">

                        {{ translate('National ID') }}

                    </h4>

                    @if ($kyc->national_id)

                        @if (Str::endsWith($kyc->national_id, '.pdf'))
                            <a href="{{ asset('storage/' . $kyc->national_id) }}" target="_blank"
                                class="text-blue-600 underline">

                                {{ translate('View PDF') }}

                            </a>
                        @else
                            <img src="{{ asset('storage/' . $kyc->national_id) }}"
                                class="w-full h-72 object-cover rounded-lg border">
                        @endif
                    @else
                        <p class="text-gray-500">

                            {{ translate('Not Uploaded') }}

                        </p>

                    @endif

                </div>

                {{-- Passport --}}

                <div class="border rounded-lg p-5">

                    <h4 class="font-bold mb-4">

                        {{ translate('Passport') }}

                    </h4>

                    @if ($kyc->passport)

                        @if (Str::endsWith($kyc->passport, '.pdf'))
                            <a href="{{ asset('storage/' . $kyc->passport) }}" target="_blank"
                                class="text-blue-600 underline">

                                {{ translate('View PDF') }}

                            </a>
                        @else
                            <img src="{{ asset('storage/' . $kyc->passport) }}"
                                class="w-full h-72 object-cover rounded-lg border">
                        @endif
                    @else
                        <p class="text-gray-500">

                            {{ translate('Not Uploaded') }}

                        </p>

                    @endif

                </div>

                {{-- Selfie --}}

                <div class="md:col-span-2 border rounded-lg p-5">

                    <h4 class="font-bold mb-4">

                        {{ translate('Selfie') }}

                    </h4>

                    @if ($kyc->selfie)
                        <img src="{{ asset('storage/' . $kyc->selfie) }}" class="w-72 rounded-lg border">
                    @else
                        <p class="text-gray-500">

                            {{ translate('Not Uploaded') }}

                        </p>
                    @endif

                </div>

            </div>

            <div class="mt-10 border-t pt-6">

                <h3 class="font-bold text-lg mb-3">

                    {{ translate('Submission Information') }}

                </h3>

                <p>

                    <strong>{{ translate('Submitted At') }} :</strong>

                    {{ $kyc->created_at->format('d M Y h:i A') }}

                </p>

                @if ($kyc->verified_at)
                    <p class="mt-2">

                        <strong>{{ translate('Verified At') }} :</strong>

                        {{ \Carbon\Carbon::parse($kyc->verified_at)->format('d M Y h:i A') }}

                    </p>
                @endif

            </div>

        </div>

    </div>

</body>

</html>
