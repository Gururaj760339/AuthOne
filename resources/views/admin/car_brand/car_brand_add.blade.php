<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Brand | AutoOne Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-3xl font-bold text-slate-800 mb-2">
            Add Car Brand
        </h2>

        <p class="text-gray-500 mb-8">
            Create a new car brand.
        </p>

        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.car.brand.add') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="space-y-6">

                <div>
                    <label class="block mb-2 font-semibold">
                        Brand Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Toyota">

                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Country
                    </label>

                    <input
                        type="text"
                        name="country"
                        value="{{ old('country') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Japan">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Brand Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

            </div>

            <div class="mt-8 flex gap-4">

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl">

                    Save Brand

                </button>

                <button
                    type="reset"
                    class="bg-gray-300 hover:bg-gray-400 px-8 py-3 rounded-xl">

                    Reset

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>