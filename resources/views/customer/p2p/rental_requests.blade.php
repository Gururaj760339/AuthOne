<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Rental Requests') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        @include('ai_layer.ai_language_translate')

        <h2 class="text-3xl font-bold mb-8">
            {{ translate('My Car Rental Requests') }}
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
                            {{ translate($booking->car->brand) }}
                            {{ translate($booking->car->model) }}
                        </h3>

                        <p><strong>{{ translate('Customer') }}:</strong> {{ translate($booking->user->name) }}</p>

                        <p><strong>{{ translate('Email') }}:</strong> {{ translate($booking->user->email) }}</p>

                        <p><strong>{{ translate('Phone') }}:</strong> {{ translate($booking->user->phone) }}</p>

                    </div>

                    <div>

                        <p>
                            <strong>{{ translate('Pickup') }}:</strong>
                            {{ translate($booking->pickup_date) }}
                        </p>

                        <p>
                            <strong>{{ translate('Return') }}:</strong>
                            {{ translate($booking->return_date) }}
                        </p>

                        <p>
                            <strong>{{ translate('Total') }}:</strong>
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
                                    {{ translate('Pending') }}
                                </option>

                                <option value="accepted" {{ $booking->status == 'accepted' ? 'selected' : '' }}>
                                    {{ translate('Accepted') }}
                                </option>

                                <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>
                                    {{ translate('Rejected') }}
                                </option>

                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>
                                    {{ translate('Completed') }}
                                </option>

                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                    {{ translate('Cancelled') }}
                                </option>

                            </select>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                {{ translate('Update') }}
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-lg shadow p-10 text-center">
                {{ translate('No rental requests found.') }}
            </div>
        @endforelse

        {{ $bookings->links() }}

    </div>

</body>

</html>
