<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Part Images</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Spare Parts Gallery
        </h1>

        <a href="{{ route('vendor.spare-parts.index') }}"
           class="bg-gray-800 hover:bg-black text-white px-5 py-2 rounded-lg">
            Back
        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-500 text-green-700 px-5 py-3 rounded mb-6">
            {{ session('success') }}
        </div>

    @endif

    @if($parts->count())

        <div class="grid lg:grid-cols-2 gap-8">

            @foreach($parts as $part)

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                    {{-- Main Image --}}

                    @if($part->image)

                        <img src="{{ asset('storage/'.$part->image) }}"
                             class="w-full h-64 object-cover">

                    @else

                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">

                            <span class="text-gray-500">
                                No Main Image
                            </span>

                        </div>

                    @endif

                    <div class="p-6">

                        <div class="flex justify-between items-center">

                            <div>

                                <h2 class="text-2xl font-bold">
                                    {{ $part->name }}
                                </h2>

                                <p class="text-gray-500 mt-1">
                                    {{ $part->brand }}
                                    {{ $part->model }}
                                </p>

                                <p class="text-blue-600 font-bold mt-2">
                                    ${{ number_format($part->price,2) }}
                                </p>

                            </div>

                            <a href="{{ route('vendor.spare.images.create',$part->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                                Add Images

                            </a>

                        </div>

                        <hr class="my-5">

                        <h3 class="font-semibold text-lg mb-4">

                            Gallery Images

                        </h3>

                        @if($part->sparePartImages->count())

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                                @foreach($part->sparePartImages as $image)

                                    <div class="relative">

                                        <img
                                            src="{{ asset('uploads/spare_parts/'.$image->image) }}"
                                            class="w-full h-32 rounded-lg object-cover">

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="bg-gray-100 rounded-lg p-6 text-center text-gray-500">

                                No Additional Images

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-xl shadow p-16 text-center">

            <h2 class="text-3xl font-bold text-gray-600">

                No Spare Parts Found

            </h2>

            <p class="text-gray-400 mt-3">

                Please add spare parts first.

            </p>

        </div>

    @endif

</div>

</body>
</html>