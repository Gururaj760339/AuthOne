<!DOCTYPE html>
<html>
<head>
    <title>{{ translate('Verification Rejected') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-20">

    <div class="bg-white shadow-lg rounded-lg p-8 text-center">

        <div class="text-red-500 text-6xl mb-5">
            ❌
        </div>

        <h2 class="text-3xl font-bold">
            {{ translate('Verification Rejected') }}
        </h2>

        <p class="text-gray-600 mt-4">
            {{ translate('Unfortunately your verification request was rejected.') }}
        </p>

        @if($verification->admin_note)

            <div class="bg-red-100 border border-red-300 rounded p-4 mt-6">

                <strong>{{ translate('Reason:') }}</strong>

                <br>

                {{ translate($verification->admin_note) }}

            </div>

        @endif

        <form action="{{ route('p2p.verifications.create') }}"
              method="GET">

            <button
                class="mt-8 bg-blue-600 text-white px-6 py-3 rounded-lg">
                {{ translate('Submit Again') }}
            </button>

        </form>

    </div>

</div>

</body>
</html>