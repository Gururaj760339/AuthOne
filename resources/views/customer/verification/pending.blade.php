<!DOCTYPE html>
<html>
<head>
    <title>{{ translate('Verification Pending') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-20">

    <div class="bg-white shadow-lg rounded-lg p-8 text-center">

        <div class="text-yellow-500 text-6xl mb-5">
            ⏳
        </div>

        <h2 class="text-3xl font-bold">
            {{ translate('Verification Pending') }}
        </h2>

        <p class="text-gray-600 mt-4">
            {{ translate('Your verification request has been submitted successfully.') }}
        </p>

        <p class="mt-2">
            {{ translate('Our admin team will review your documents.') }}
        </p>

        <a href="{{ route('customer.profile') }}"
           class="inline-block mt-8 bg-blue-600 text-white px-6 py-3 rounded-lg">
            {{ translate('Back to Home') }}
        </a>

    </div>

</div>

</body>
</html>