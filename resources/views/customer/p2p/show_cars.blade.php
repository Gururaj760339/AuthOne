<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P2P Rental Cars</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-4">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">
                P2P Rental Cars
            </h1>

            <a href="{{ route('p2p.cars.create') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Add Car
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
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
                                            {{ $car->brand }} {{ $car->model }}
                                        </h2>

                                        <p class="text-gray-500">
                                            {{ $car->year }}
                                        </p>

                                    </div>

                                    <div>

                                        @if ($car->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                                                Pending
                                            </span>
                                        @elseif($car->status == 'approved')
                                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                                                Approved
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">
                                                Rejected
                                            </span>
                                        @endif

                                    </div>

                                </div>

                                <div class="grid grid-cols-2 gap-3 mt-5">

                                    <p><strong>Owner :</strong> {{ $car->user->name }}</p>

                                    <p><strong>Fuel :</strong> {{ $car->fuel_type }}</p>

                                    <p><strong>Color :</strong> {{ $car->color }}</p>

                                    <p><strong>Seats :</strong> {{ $car->seats }}</p>

                                    <p><strong>Registration :</strong> {{ $car->registration_no }}</p>

                                    <p>
                                        <strong>Price :</strong>

                                        <span class="text-blue-600 font-bold">
                                            ${{ number_format($car->price_per_day, 2) }}/Day
                                        </span>

                                    </p>

                                </div>

                                @if ($car->status == 'rejected' && $car->reject_reason)
                                    <div class="mt-4 bg-red-100 border border-red-300 p-3 rounded">

                                        <strong>Reject Reason:</strong>

                                        {{ $car->reject_reason }}

                                    </div>
                                @endif

                                <div class="flex gap-3 mt-6">


                                    <form action="{{ route('p2p.cars.destroy', $car->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this car?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">

                                            Delete

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
                    No Cars Found
                </h2>

                <p class="text-gray-500 mt-2">
                    There are no approved cars available for rental.
                </p>

            </div>

        @endif

    </div>

</body>

</html>
