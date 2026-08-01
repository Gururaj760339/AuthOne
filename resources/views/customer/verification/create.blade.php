<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Verification</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white rounded-lg shadow-lg">

        <div class="border-b px-6 py-4">
            <h2 class="text-2xl font-bold">User Verification</h2>
            <p class="text-gray-500">
                Verify your identity to list your car for P2P Rental.
            </p>
        </div>

        <div class="p-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-5">
                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('p2p.verifications.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block font-semibold mb-2">
                            NID Number
                        </label>

                        <input type="text"
                               name="nid_number"
                               value="{{ old('nid_number') }}"
                               class="w-full border rounded-lg p-3"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Driving License Number
                        </label>

                        <input type="text"
                               name="driving_license_number"
                               value="{{ old('driving_license_number') }}"
                               class="w-full border rounded-lg p-3"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            NID Front Image
                        </label>

                        <input type="file"
                               name="nid_front_image"
                               class="w-full border rounded-lg p-3"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            NID Back Image
                        </label>

                        <input type="file"
                               name="nid_back_image"
                               class="w-full border rounded-lg p-3"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Driving License Image
                        </label>

                        <input type="file"
                               name="driving_license_image"
                               class="w-full border rounded-lg p-3"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Selfie (Optional)
                        </label>

                        <input type="file"
                               name="selfie_image"
                               class="w-full border rounded-lg p-3">
                    </div>

                </div>

                <div class="mt-8 flex justify-between">

                    <a href="{{ route('customer.profile') }}"
                       class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
                        Back
                    </a>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Submit Verification
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>