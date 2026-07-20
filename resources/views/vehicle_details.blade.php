<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $car->title }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    @include('navbar', ['setting' => $setting])

    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid lg:grid-cols-2 gap-10">

            {{-- Images --}}
            <div>

                @php
                    $mainImage = $car->thumbnail
                        ? asset('storage/' . $car->thumbnail)
                        : asset('images/no-image.png');
                @endphp

                <img id="mainImage"
                    src="{{ $mainImage }}"
                    class="w-full h-[500px] object-cover rounded-xl shadow-lg transition-all duration-300">

                <div class="grid grid-cols-4 gap-3 mt-4">

                    {{-- Thumbnail --}}
                    @if($car->thumbnail)
                        <img
                            src="{{ asset('storage/' . $car->thumbnail) }}"
                            onclick="changeImage(this)"
                            class="cursor-pointer h-24 w-full object-cover rounded-lg border-2 border-blue-600 hover:scale-105 transition">
                    @endif

                    {{-- Gallery Images --}}
                    @foreach ($car->carImages as $image)

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            onclick="changeImage(this)"
                            class="cursor-pointer h-24 w-full object-cover rounded-lg border hover:border-blue-600 hover:scale-105 transition">

                    @endforeach

                </div>

            </div>

            {{-- Details --}}
            <div>

                <h1 class="text-4xl font-bold">
                    {{ $car->title }}
                </h1>

                <p class="text-gray-500 mt-2 text-lg">
                    {{ $car->carBrand?->name }}
                </p>

                <h2 class="text-4xl font-bold text-blue-600 mt-6">
                    ${{ number_format($car->price,2) }}
                </h2>

                <div class="grid grid-cols-2 gap-4 mt-8">

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Year</p>
                        <h4 class="font-bold">{{ $car->year }}</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Fuel</p>
                        <h4 class="font-bold">{{ $car->fuel_type }}</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Transmission</p>
                        <h4 class="font-bold">{{ $car->transmission }}</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Mileage</p>
                        <h4 class="font-bold">{{ number_format($car->mileage) }} km</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Engine</p>
                        <h4 class="font-bold">{{ $car->engine }}</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Horsepower</p>
                        <h4 class="font-bold">{{ $car->horsepower }} HP</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Color</p>
                        <h4 class="font-bold">{{ $car->color }}</h4>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-500">Condition</p>
                        <h4 class="font-bold">{{ ucfirst($car->condition) }}</h4>
                    </div>

                </div>

                <div class="mt-8">

                    <h3 class="text-2xl font-bold mb-3">
                        Description
                    </h3>

                    <p class="text-gray-600 leading-8">
                        {{ $car->description }}
                    </p>

                </div>

                <div class="mt-8">

                    <a href="{{ route('customer.single.finance.request', $car->slug) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition">
                        Book Test Drive
                    </a>

                </div>

            </div>

        </div>

        {{-- Related Cars --}}
        @if($relatedCars->count())

            <div class="mt-20">

                <h2 class="text-3xl font-bold mb-8">
                    Related Vehicles
                </h2>

                <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6">

                    @foreach($relatedCars as $item)

                        <div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden">

                            <img
                                src="{{ asset('storage/'.$item->thumbnail) }}"
                                class="w-full h-56 object-cover">

                            <div class="p-5">

                                <h3 class="font-bold text-xl">
                                    {{ $item->title }}
                                </h3>

                                <p class="text-gray-500">
                                    {{ $item->year }}
                                </p>

                                <p class="text-blue-600 text-2xl font-bold mt-2">
                                    ${{ number_format($item->price,2) }}
                                </p>

                                <a href="{{ route('vehicle.details',$item->slug) }}"
                                    class="inline-block mt-4 bg-black hover:bg-gray-800 text-white px-5 py-2 rounded-lg transition">
                                    View Details
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>

    <script>
        function changeImage(img) {
            document.getElementById('mainImage').src = img.src;

            document.querySelectorAll('.grid img').forEach(item => {
                item.classList.remove('border-blue-600', 'border-2');
                item.classList.add('border');
            });

            img.classList.remove('border');
            img.classList.add('border-blue-600', 'border-2');
        }
    </script>

</body>

</html>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>