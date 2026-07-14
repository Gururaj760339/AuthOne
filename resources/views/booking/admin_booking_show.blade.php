<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white px-4 py-3 rounded mb-5">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg">

        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold">
                Manage Bookings
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-200">

                <tr>

                    <th class="p-3">ID</th>

                    <th class="p-3">Customer</th>

                    <th class="p-3">Service</th>

                    <th class="p-3">Booking Date</th>

                    <th class="p-3">Booking Time</th>

                    <th class="p-3">Notes</th>

                    <th class="p-3">Status</th>

                    <th class="p-3">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($bookings as $booking)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            {{ $booking->id }}
                        </td>

                        <td class="p-3">
                            {{ $booking->user->name ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $booking->service->title ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $booking->booking_date }}
                        </td>

                        <td class="p-3">
                            {{ $booking->booking_time }}
                        </td>

                        <td class="p-3">
                            {{ $booking->notes }}
                        </td>

                        <td class="p-3">

                            <form action="{{ route('admin.booking.update',$booking->id) }}"
                                  method="POST"
                                  class="flex gap-2">

                                @csrf

                                <select
                                    name="status"
                                    class="border rounded px-3 py-2">

                                    <option value="pending"
                                        {{ $booking->status=='Pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="confirmed"
                                        {{ $booking->status=='Confirmed' ? 'selected' : '' }}>
                                        Confirmed
                                    </option>

                                    <option value="completed"
                                        {{ $booking->status=='Completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>

                                    <option value="cancelled"
                                        {{ $booking->status=='Cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>

                                </select>

                                <button
                                    type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded">

                                    Update

                                </button>

                            </form>

                        </td>

                        <td class="p-3">

                            <form action="{{ route('admin.booking.delete',$booking->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Are you sure you want to delete this booking?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center p-6">

                            No Booking Found.

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