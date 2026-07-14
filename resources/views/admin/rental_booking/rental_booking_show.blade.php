<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Bookings</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-5">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg">

            <div class="p-6 border-b">
                <h2 class="text-3xl font-bold">
                    Rental Booking List
                </h2>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Car</th>
                            <th class="p-4">Pickup</th>
                            <th class="p-4">Return</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($bookings as $booking)
                            <tr class="border-b">

                                <td class="p-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-4">
                                    {{ $booking->user->name }}
                                </td>

                                <td class="p-4">
                                    {{ $booking->rental->car->title }}
                                </td>

                                <td class="p-4">
                                    {{ $booking->pickup_date }}
                                </td>

                                <td class="p-4">
                                    {{ $booking->return_date }}
                                </td>

                                <td class="p-4">

                                    <form action="{{ route('admin.rental.booking.update', $booking->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <select name="status" class="border rounded px-3 py-2">

                                            <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>

                                            <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                            <option value="Cancelled"
                                                {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>

                                        </select>

                                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                            Update
                                        </button>

                                    </form>

                                </td>

                                <td class="p-4">
                                    <form action="{{ route('admin.rental.booking.delete', $booking->id) }}"
                                        method="POST" class="inline" onsubmit="return confirm('Delete this booking?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mt-2">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center p-8">
                                    No Rental Booking Found.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>
