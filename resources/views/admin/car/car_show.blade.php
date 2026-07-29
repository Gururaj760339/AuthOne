<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars | AutoOne Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-8 px-4">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manage Cars</h1>
                <p class="text-gray-500 mt-1">All Cars List</p>
            </div>

            @if (Auth::check() && Auth::user()->vendor)
                <a href="{{ route('vendor.cars.add.form') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                    + Add Car
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-x-auto">

            <table class="min-w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-left">Brand</th>
                        <th class="px-4 py-3 text-left">Title</th>
                        <th class="px-4 py-3 text-left">Price</th>
                        <th class="px-4 py-3 text-left">Year</th>
                        <th class="px-4 py-3 text-left">Fuel</th>
                        <th class="px-4 py-3 text-left">Transmission</th>
                        <th class="px-4 py-3 text-left">Mileage</th>
                        @if (Auth::user()->role === 'admin')
                            <th class="p-3">Status</th>
                        @endif
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($cars as $car)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3">
                                <img src="{{ asset('storage/' . $car->thumbnail) }}"
                                    class="w-20 h-14 object-cover rounded">
                            </td>

                            <td class="px-4 py-3">
                                {{ $car->carBrand?->name }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $car->title }}
                            </td>

                            <td class="px-4 py-3">
                                ${{ number_format($car->price) }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $car->year }}
                            </td>

                            <td class="px-4 py-3">
                                {{ ucfirst($car->fuel_type) }}
                            </td>

                            <td class="px-4 py-3">
                                {{ ucfirst($car->transmission) }}
                            </td>

                            <td class="px-4 py-3">
                                {{ number_format($car->mileage) }} km
                            </td>

                    @if (Auth::user()->role === 'admin')
                        <td class="p-3">

                            <form action="{{ route('admin.car.status.update', $car->id) }}" method="POST"
                                class="flex gap-2">
                                @method('PUT')
                                @csrf

                                <select name="status" class="border rounded px-3 py-2">
                                    <option value="1" {{ $car->status == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0" {{ $car->status == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>

                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 rounded">

                                    Update

                                </button>

                            </form>

                        </td>
                    @endif


                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.vendor.cars.edit', $car->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.vendor.cars.delete', $car->id) }}" method="POST"
                                onsubmit="return confirm('Delete this car?')">

                                @csrf
                                @method('DELETE')

                                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                    </tr>

                    @empty

                        <tr>
                            <td colspan="11" class="text-center py-10 text-gray-500">
                                No Cars Found
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </body>

    </html>
