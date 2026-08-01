<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Requests</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        <h2 class="text-3xl font-bold mb-8">
            My Car Rental Requests
        </h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        @forelse($bookings as $booking)
            <div class="bg-white rounded-lg shadow mb-6 p-6">

                <div class="grid md:grid-cols-4 gap-6">

                    <div>
                        <img src="{{ asset('storage/' . $booking->car->main_image) }}"
                            class="w-full h-40 object-cover rounded">
                    </div>

                    <div>

                        <h3 class="text-xl font-bold">
                            {{ $booking->car->brand }}
                            {{ $booking->car->model }}
                        </h3>

                        <p><strong>Customer:</strong> {{ $booking->user->name }}</p>

                        <p><strong>Email:</strong> {{ $booking->user->email }}</p>

                        <p><strong>Phone:</strong> {{ $booking->user->phone }}</p>

                    </div>

                    <div>

                        <p>
                            <strong>Pickup:</strong>
                            {{ $booking->pickup_date }}
                        </p>

                        <p>
                            <strong>Return:</strong>
                            {{ $booking->return_date }}
                        </p>

                        <p>
                            <strong>Total:</strong>
                            ${{ number_format($booking->total_amount, 2) }}
                        </p>

                    </div>

                    <div>

                        <form action="{{ route('p2p.cars.rental.status.update', $booking->id) }}" method="POST"
                            class="flex items-center gap-3">

                            @csrf
                            @method('PUT')

                            <select name="status" class="border rounded-lg p-2">

                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="accepted" {{ $booking->status == 'accepted' ? 'selected' : '' }}>
                                    Accepted
                                </option>

                                <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>
                                    Rejected
                                </option>

                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Update
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-lg shadow p-10 text-center">
                No rental requests found.
            </div>
        @endforelse

        {{ $bookings->links() }}

    </div>

</body>

</html>
