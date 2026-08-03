<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('P2P Rental Cars') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-4">

        @include('ai_layer.ai_language_translate')

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">
                {{ translate('P2P Rental Cars') }}
            </h1>

            <a href="{{ route('p2p.cars.create') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                {{ translate('Add Car') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-6">
                {{ translate(session('success')) }}
            </div>
        @endif

        @if ($cars->count())

            <div class="space-y-6">

                @foreach ($cars as $car)
                    <div class="bg-white rounded-xl shadow-lg p-5">

                        <div class="flex flex-col md:flex-row gap-6">

                            <!-- Image -->
                            <div class="w-full md:w-72">
                                <img src="{{ $car->main_image ? asset('storage/' . $car->main_image) : asset('images/no-car.png') }}"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>

                            <!-- Details -->
                            <div class="flex-1">

                                <div class="flex justify-between">

                                    <div>

                                        <h2 class="text-2xl font-bold">
                                            {{ translate($car->brand) }} {{ translate($car->model) }}
                                        </h2>

                                        <p class="text-gray-500">
                                            {{ translate($car->year) }} | {{ translate($car->registration_no) }}   
                                        </p>

                                    </div>

                                    <div>

                                        @if ($car->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                                                {{ translate('Pending') }}
                                            </span>
                                        @elseif($car->status == 'approved')
                                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                                                {{ translate('Approved') }}
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">
                                                {{ translate('Rejected') }}
                                            </span>
                                        @endif

                                    </div>

                                </div>

                                <div class="grid grid-cols-2 gap-3 mt-5">

                                    <p><strong>{{ translate('Owner') }} :</strong> {{ translate($car->user->name) }}</p>

                                    <p><strong>{{ translate('Fuel') }} :</strong> {{ translate($car->fuel_type) }}</p>

                                    <p><strong>{{ translate('Color') }} :</strong> {{ translate($car->color) }}</p>

                                    <p><strong>{{ translate('Seats') }} :</strong> {{ translate($car->seats) }}</p>

                                    <p><strong>{{ translate('Registration') }} :</strong> {{ translate($car->registration_no) }}</p>

                                    <p>
                                        <strong>{{ translate('Price') }} :</strong>

                                        <span class="text-blue-600 font-bold">
                                            ${{ number_format($car->price_per_day, 2) }}/{{ translate('Day') }}
                                        </span>

                                    </p>

                                </div>

                                @if ($car->status == 'rejected' && $car->reject_reason)
                                    <div class="mt-4 bg-red-100 border border-red-300 p-3 rounded">

                                        <strong>{{ translate('Reject Reason') }}:</strong>

                                        {{ translate($car->reject_reason) }}

                                    </div>
                                @endif

                                <div class="flex gap-3 mt-6">


                                    <form action="{{ route('p2p.cars.destroy', $car->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this car?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">

                                            {{ translate('Delete') }}

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

            <div class="mt-8">
                {{ $cars->links() }}
            </div>
        @else
            <div class="bg-white shadow rounded-lg p-10 text-center">

                <h2 class="text-2xl font-bold">
                    {{ translate('No Cars Found') }}
                </h2>

                <p class="text-gray-500 mt-2">
                    {{ translate('There are no approved cars available for rental.') }}
                </p>

            </div>

        @endif

    </div>

</body>

</html>
