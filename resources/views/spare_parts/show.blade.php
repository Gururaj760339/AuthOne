<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Parts Catalog</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @include('navbar', ['setting' => $setting])

    <div class="max-w-7xl mx-auto py-10 px-5">

        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-gray-800">
                Spare Parts Catalog
            </h1>

            <p class="text-gray-500 mt-3">
                Tires • Brakes • Batteries • Oils • Accessories
            </p>

        </div>

        {{-- Search Section --}}
        <div class="max-w-3xl mx-auto mb-10">

            <form action="{{ route('customer.spare.parts') }}" method="GET">

                <div class="flex flex-col md:flex-row gap-3">

                    {{-- Car Model Search --}}
                    <div class="flex-1 relative">

                        <input type="text" name="car_model" value="{{ request('car_model') }}"
                            placeholder="Search spare parts by car model... e.g. Toyota Corolla"
                            class="w-full border border-gray-300 rounded-lg px-5 py-3
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none">

                    </div>

                    {{-- Category --}}
                    <select name="category"
                        class="border border-gray-300 rounded-lg px-5 py-3
                       focus:ring-2 focus:ring-blue-500 outline-none">

                        <option value="">All Categories</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>
                        @endforeach

                    </select>

                    {{-- Search Button --}}
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white
                       px-7 py-3 rounded-lg font-semibold">

                        Search

                    </button>

                </div>

            </form>

            {{-- Clear Search --}}
            @if (request('car_model') || request('category'))
                <div class="text-center mt-4">

                    <a href="{{ route('customer.spare.parts') }}" class="text-red-500 hover:text-red-700 text-sm">

                        Clear Search

                    </a>

                </div>
            @endif

        </div>

        {{-- Categories --}}

        <div class="flex flex-wrap gap-3 justify-center mb-10">

            @foreach ($categories as $category)
                <span class="bg-blue-600 text-white px-5 py-2 rounded-full">

                    {{ $category->name }}

                </span>
            @endforeach

        </div>

        {{-- Products --}}

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @forelse($spareParts as $part)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl duration-300">

                    @if ($part->image)
                        <img src="{{ asset('storage/' . $part->image) }}" class="w-full h-56 object-cover">
                    @else
                        <div class="h-56 bg-gray-200 flex items-center justify-center">

                            No Image

                        </div>
                    @endif

                    <div class="p-5">

                        <span class="text-sm text-blue-600 font-semibold">

                            {{ $part->sparePartsCategory->name }}

                        </span>

                        <h2 class="text-xl font-bold mt-2">

                            {{ $part->name }}

                        </h2>

                        <p class="text-gray-500 mt-1">

                            {{ $part->brand }}

                            {{ $part->model }}

                        </p>

                        <div class="mt-4 flex justify-between">

                            <span class="text-green-600 font-bold text-xl">

                                ${{ number_format($part->price, 2) }}

                            </span>

                            <span class="text-gray-500">

                                Stock:
                                {{ $part->stock }}

                            </span>

                        </div>

                        <a href="{{ route('customer.spare.parts.show', $part->id) }}"
                            class="block text-center mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg">

                            View Details

                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-4 text-center bg-white rounded-xl shadow p-16">

                    <h2 class="text-2xl font-bold">

                        No Spare Parts Available

                    </h2>

                </div>
            @endforelse

        </div>

    </div>

</body>

</html>
