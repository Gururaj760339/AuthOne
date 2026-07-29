<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rentals</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    @if(session('success'))
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

        <div class="flex justify-between items-center p-6 border-b">

            <h2 class="text-3xl font-bold">
                Manage Rentals
            </h2>

            @if(Auth::check() && Auth::user()->vendor)
            <a href="{{ route('vendor.rental.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                + Add Rental
            </a>
            @endif

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Car</th>
                    <th class="p-4 text-left">Per Day</th>
                    <th class="p-4 text-left">Per Week</th>
                    <th class="p-4 text-left">Per Month</th>
                    <th class="p-4 text-left">Available</th>
                    <th class="p-4 text-center">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($rentals as $rental)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-4 font-semibold">
                            {{ $rental->car->title ?? 'N/A' }}
                        </td>

                        <td class="p-4">
                            ${{ number_format($rental->price_per_day,2) }}
                        </td>

                        <td class="p-4">
                            ${{ number_format($rental->price_per_week,2) }}
                        </td>

                        <td class="p-4">
                            ${{ number_format($rental->price_per_month,2) }}
                        </td>

                        <td class="p-4">

                            @if($rental->available)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Available
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Not Available
                                </span>

                            @endif

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.vendor.rental.edit',$rental->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                    Update
                                </a>

                                <form action="{{ route('admin.vendor.rental.destroy',$rental->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this rental?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center p-8 text-gray-500">
                            No Rental Found.
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