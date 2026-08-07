<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Spare Part Images</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-6">

        <div class="bg-white rounded-xl shadow-lg p-8">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-gray-800">
                        Upload Images
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Spare Part :
                        <span class="font-semibold">{{ $part->name }}</span>
                    </p>

                </div>

                <a href="{{ route('vendor.spare.images') }}"
                    class="bg-gray-700 hover:bg-black text-white px-5 py-2 rounded-lg">
                    Back
                </a>

            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-500 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())

                <div class="bg-red-100 border border-red-500 text-red-700 p-4 rounded-lg mb-6">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('vendor.spare.images.store', $part->id) }}" method="POST"
                enctype="multipart/form-data" class="mb-10">

                @csrf

                <label class="block font-semibold mb-3">
                    Select Images
                </label>

                <input type="file" name="images[]" multiple required class="w-full border rounded-lg p-3">

                <button class="mt-5 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                    Upload Images

                </button>

            </form>

            <hr class="mb-8">

            <h2 class="text-2xl font-bold mb-6">
                Uploaded Images
            </h2>

            @if ($part->sparePartImages->count())

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                    @foreach ($part->sparePartImages as $image)
                        <div class="bg-white border rounded-lg shadow">

                            <img src="{{ asset('uploads/spare_parts/' . $image->image) }}"
                                class="w-full h-52 object-cover rounded-t-lg">

                            <div class="p-4">

                                <form action="{{ route('vendor.spare.images.destroy', $image->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete this image?')"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-10 text-center text-gray-500">

                    No Images Uploaded Yet

                </div>

            @endif

        </div>

    </div>

</body>

</html>
