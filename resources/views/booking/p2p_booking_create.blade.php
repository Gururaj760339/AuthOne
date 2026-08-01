<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P2P Car Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto py-10">

    @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-400 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded mb-5">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        <div class="grid md:grid-cols-2">

            <div>
                <img src="{{ asset('storage/'.$car->main_image) }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="p-6">

                <h2 class="text-3xl font-bold">
                    {{ $car->brand }} {{ $car->model }}
                </h2>

                <p class="mt-3">
                    <strong>Owner:</strong>
                    {{ $car->user->name }}
                </p>

                <p>
                    <strong>Price:</strong>
                    ${{ number_format($car->price_per_day,2) }}/Day
                </p>

                <hr class="my-5">

                <form action="{{ route('p2p.booking.store', $car->id) }}"
                      method="POST">

                    @csrf

                    <input type="hidden"
                           name="car_id"
                           value="{{ $car->id }}">

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Pickup Date
                        </label>

                        <input type="date"
                               name="pickup_date"
                               min="{{ date('Y-m-d') }}"
                               class="w-full border rounded-lg p-3"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Return Date
                        </label>

                        <input type="date"
                               name="return_date"
                               class="w-full border rounded-lg p-3"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Pickup Location
                        </label>

                        <input type="text"
                               name="pickup_location"
                               class="w-full border rounded-lg p-3"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="4"
                            class="w-full border rounded-lg p-3"></textarea>

                    </div>

                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg">

                        Continue Booking

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>