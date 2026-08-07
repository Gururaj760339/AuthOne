<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $part->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-5">

        <a href="{{ route('customer.spare.parts') }}"
            class="inline-block mb-6 bg-gray-700 hover:bg-gray-800 text-white px-5 py-2 rounded-lg">
            ← Back
        </a>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <div class="grid lg:grid-cols-2 gap-8 p-8">

                {{-- Left Side --}}

                <div>

                    @if ($part->image)
                        <img src="{{ asset('storage/' . $part->image) }}"
                            class="w-full h-[450px] object-cover rounded-lg">
                    @else
                        <div class="h-[450px] bg-gray-200 flex items-center justify-center rounded-lg">

                            No Image

                        </div>
                    @endif

                    {{-- Gallery Images --}}

                    @if ($part->sparePartImages->count())

                        <div class="grid grid-cols-4 gap-3 mt-5">

                            @foreach ($part->sparePartImages as $image)
                                <img src="{{ asset('uploads/spare_parts/' . $image->image) }}"
                                    class="h-24 w-full object-cover rounded-lg border">
                            @endforeach

                        </div>

                    @endif

                </div>

                {{-- Right Side --}}

                <div>

                    <span class="bg-blue-600 text-white px-4 py-1 rounded-full">

                        {{ $part->sparePartsCategory->name }}

                    </span>

                    <h1 class="text-4xl font-bold mt-5">

                        {{ $part->name }}

                    </h1>

                    <h2 class="text-3xl font-bold text-green-600 mt-5">

                        ${{ number_format($part->price, 2) }}

                    </h2>

                    <div class="mt-8 space-y-3 text-gray-700">

                        <p>
                            <strong>Brand :</strong>
                            {{ $part->brand }}
                        </p>

                        <p>
                            <strong>Model :</strong>
                            {{ $part->model }}
                        </p>

                        <p>
                            <strong>Part Number :</strong>
                            {{ $part->part_number }}
                        </p>

                        <p>
                            <strong>Country :</strong>
                            {{ $part->country }}
                        </p>

                        <p>
                            <strong>Unit :</strong>
                            {{ $part->unit }}
                        </p>

                        <p>
                            <strong>Stock :</strong>
                            {{ $part->stock }}
                        </p>

                        <p>

                            <strong>Status :</strong>

                            @if ($part->status == 'Available')
                                <span class="text-green-600 font-bold">

                                    Available

                                </span>
                            @elseif($part->status == 'Out of Stock')
                                <span class="text-yellow-600 font-bold">

                                    Out of Stock

                                </span>
                            @else
                                <span class="text-red-600 font-bold">

                                    Inactive

                                </span>
                            @endif

                        </p>

                    </div>

                    <div class="mt-8">

                        <h3 class="text-xl font-bold mb-3">

                            Description

                        </h3>

                        <p class="text-gray-600 leading-7">

                            {{ $part->description }}

                        </p>

                    </div>

                    <form action="{{ route('customer.cart.add', $part->id) }}" method="POST">
                        @csrf

                        <div class="flex items-center gap-3 mb-4">

                            <label class="font-semibold">
                                Quantity
                            </label>

                            <input type="number" name="quantity" value="1" min="1"
                                class="border rounded-lg px-3 py-2 w-24">

                        </div>

                        @if (Auth::check())
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                                Add to Cart
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                                Add to Cart
                            </a>
                        @endif
                    </form>

                    </form>
                </div>

            </div>

        </div>

    </div>

</body>

</html>
