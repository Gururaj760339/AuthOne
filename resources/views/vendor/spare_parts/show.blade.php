<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Parts</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Spare Parts
            </h1>

            <a href="{{ route('vendor.spare-parts.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                + Add Spare Part
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-500 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($parts->count())

        <div class="overflow-x-auto">

            <table class="min-w-full border border-gray-200">

                <thead class="bg-gray-800 text-white">

                    <tr>

                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Brand</th>
                        <th class="px-4 py-3">Model</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Action</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($parts as $part)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-3">

                            @if($part->image)

                                <img
                                    src="{{ asset('storage/'.$part->image) }}"
                                    class="w-20 h-20 rounded-lg object-cover">

                            @else

                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                    No Image
                                </div>

                            @endif

                        </td>

                        <td class="px-4 py-3 font-semibold">
                            {{ $part->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $part->category->name ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $part->brand }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $part->model }}
                        </td>

                        <td class="px-4 py-3 text-green-600 font-bold">
                            ${{ number_format($part->price,2) }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $part->stock }}
                        </td>

                        <td class="px-4 py-3">

                            @if($part->status=='Available')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Available
                                </span>

                            @elseif($part->status=='Out of Stock')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Out of Stock
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">

                            <div class="flex gap-2">

                                <a href="{{ route('vendor.spare-parts.edit',$part->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('vendor.spare-parts.destroy',$part->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this spare part?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="text-center py-20">

            <h2 class="text-2xl font-semibold text-gray-500">
                No Spare Parts Found
            </h2>

            <p class="text-gray-400 mt-2">
                Click the button above to add your first spare part.
            </p>

        </div>

        @endif

    </div>

</div>

</body>
</html>