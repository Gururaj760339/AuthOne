<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('KYC Verification') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto py-10 px-4">

        <div class="bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-3xl font-bold mb-6">
                {{ translate('KYC Verification') }}
            </h2>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Already Submitted --}}
            @if($kyc)

                <div class="border rounded-xl p-6 bg-gray-50">

                    <h3 class="text-xl font-semibold mb-4">
                        {{ translate('KYC Status') }}
                    </h3>

                    @if($kyc->status == 'pending')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded">
                            {{ translate('Pending') }}
                        </span>

                    @elseif($kyc->status == 'verified')
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded">
                            {{ translate('Verified') }}
                        </span>

                    @else
                        <span class="px-4 py-2 bg-red-100 text-red-700 rounded">
                            {{ translate('Rejected') }}
                        </span>

                        <div class="mt-4">
                            <strong>{{ translate('Reason') }}:</strong>
                            {{ translate($kyc->rejection_reason) }}
                        </div>
                    @endif

                </div>

            @else

                <form action="{{ route('customer.store.kyc') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="font-semibold">
                                {{ translate('Driver License Front') }} *
                            </label>

                            <input type="file"
                                   name="driver_license_front"
                                   class="mt-2 w-full border rounded-lg p-3"
                                   required>
                        </div>

                        <div>
                            <label class="font-semibold">
                                {{ translate('Driver License Back') }} *
                            </label>

                            <input type="file"
                                   name="driver_license_back"
                                   class="mt-2 w-full border rounded-lg p-3"
                                   required>
                        </div>

                        <div>
                            <label class="font-semibold">
                                {{ translate('National ID') }}
                            </label>

                            <input type="file"
                                   name="national_id"
                                   class="mt-2 w-full border rounded-lg p-3">
                        </div>

                        <div>
                            <label class="font-semibold">
                                {{ translate('Passport') }}
                            </label>

                            <input type="file"
                                   name="passport"
                                   class="mt-2 w-full border rounded-lg p-3">
                        </div>

                        <div class="md:col-span-2">
                            <label class="font-semibold">
                                {{ translate('Selfie') }}
                            </label>

                            <input type="file"
                                   name="selfie"
                                   class="mt-2 w-full border rounded-lg p-3">
                        </div>

                    </div>

                    <button
                        class="mt-8 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg rounded-lg">
                        {{ translate('Submit KYC') }}
                    </button>

                </form>

            @endif

            <div class="mt-8">
                <a href="{{ route('customer.profile') }}"
                   class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">
                    ← {{ translate('Back to Profile') }}
                </a>
            </div>

        </div>

    </div>

</body>

</html>