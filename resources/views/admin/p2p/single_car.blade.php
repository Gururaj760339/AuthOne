<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P2P Car Details</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        <div class="border-b px-6 py-4">
            <h2 class="text-2xl font-bold">
                P2P Car Details
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-8 p-6">

            <!-- Car Image -->
            <div>

                <img src="{{ asset('storage/'.$car->main_image) }}"
                     class="w-full h-96 object-cover rounded-lg border">

            </div>

            <!-- Car Details -->
            <div>

                <h2 class="text-3xl font-bold mb-5">
                    {{ $car->brand }} {{ $car->model }}
                </h2>

                <div class="space-y-3">

                    <p>
                        <strong>Owner :</strong>
                        {{ $car->user->name }}
                    </p>

                    <p>
                        <strong>Email :</strong>
                        {{ $car->user->email }}
                    </p>

                    <p>
                        <strong>Phone :</strong>
                        {{ $car->user->phone }}
                    </p>

                    <p>
                        <strong>Registration :</strong>
                        {{ $car->registration_no }}
                    </p>

                    <p>
                        <strong>Year :</strong>
                        {{ $car->year }}
                    </p>

                    <p>
                        <strong>Color :</strong>
                        {{ $car->color }}
                    </p>

                    <p>
                        <strong>Fuel :</strong>
                        {{ $car->fuel_type }}
                    </p>

                    <p>
                        <strong>Seats :</strong>
                        {{ $car->seats }}
                    </p>

                    <p>
                        <strong>Price :</strong>
                        ${{ number_format($car->price_per_day,2) }}/Day
                    </p>

                    <p>
                        <strong>Status :</strong>

                        @if($car->status=='pending')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                Pending
                            </span>

                        @elseif($car->status=='approved')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                Approved
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                Rejected
                            </span>

                        @endif

                    </p>

                </div>

            </div>

        </div>

        <!-- Description -->
        <div class="px-6 pb-6">

            <h3 class="text-xl font-bold mb-2">
                Description
            </h3>

            <p class="text-gray-700">
                {{ $car->description ?? 'No description available.' }}
            </p>

        </div>

        <div class="border-t p-6">

            <div class="flex justify-between items-start">

                <!-- Approve -->

                <form action="{{ route('admin.p2p.car.approve',$car->id) }}"
                      method="POST">

                    @csrf

                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

                        ✔ Approve

                    </button>

                </form>

                <!-- Reject -->

                <form action="{{ route('admin.p2p.car.reject',$car->id) }}"
                      method="POST"
                      class="flex items-start gap-3">

                    @csrf

                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">

                        ✖ Reject

                    </button>

                </form>

            </div>

        </div>

        <div class="border-t p-6">

            <a href="{{ route('admin.p2p.cars.show') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">

                ← Back

            </a>

        </div>

    </div>

</div>

</body>
</html>