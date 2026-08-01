<!DOCTYPE html>
<html>
<head>
    <title>Digital Contract</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white shadow rounded-lg p-8">

    <h1 class="text-3xl font-bold text-blue-700">
        Rental Contract Ready
    </h1>

    <p class="mt-4">
        Payment has been completed successfully.
    </p>

    <div class="mt-6 space-x-4">

        <a href="{{ route('rental.contract.preview',$booking->id) }}"
           class="bg-blue-600 text-white px-5 py-3 rounded">

            Preview Contract

        </a>

        <a href="{{ route('rental.contract.download',$booking->id) }}"
           class="bg-green-600 text-white px-5 py-3 rounded">

            Download PDF

        </a>

    </div>

</div>

</body>
</html>