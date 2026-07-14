<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Car Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    <div class="bg-white rounded-lg shadow-lg p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Manage Car Images
            </h2>

            <a href="{{ route('admin.cars.image.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                + Add Image
            </a>

        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @forelse($images as $img)

                <div class="bg-white border rounded-lg shadow">

                    <img
                        src="{{ asset('storage/'.$img->image) }}"
                        class="w-full h-56 object-cover">

                    <div class="p-4">

                        <h3 class="font-semibold text-lg">
                            {{ $img->car->title ?? 'No Car' }}
                        </h3>

                        <form action="{{ route('admin.cars.image.destroy',$img->id) }}"
                              method="POST"
                              class="mt-4">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete this image?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">

                                Delete Image

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-4">

                    <div class="bg-yellow-100 text-yellow-700 p-6 rounded text-center">

                        No Images Found.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

</body>
</html>