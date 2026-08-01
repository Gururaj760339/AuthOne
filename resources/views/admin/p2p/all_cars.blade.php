<!DOCTYPE html>
<html>

<head>
    <title>P2P Cars</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10">

        <div class="bg-white rounded-lg shadow">

            <div class="px-6 py-4 border-b">
                <h2 class="text-2xl font-bold">
                    P2P Car Requests
                </h2>
            </div>

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3">Image</th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($cars as $car)
                        <tr class="border-b">

                            <td class="p-3">
                                <img src="{{ asset('storage/' . $car->main_image) }}"
                                    class="w-24 h-16 object-cover rounded">
                            </td>

                            <td>

                                {{ $car->brand }}

                                {{ $car->model }}

                            </td>

                            <td>

                                {{ $car->user->name }}

                            </td>

                            <td>

                                ${{ $car->price_per_day }}

                            </td>

                            <td>

                                @if ($car->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                        Pending
                                    </span>
                                @elseif($car->status == 'approved')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                        Approved
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                        Rejected
                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.p2p.car.show', $car->id) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded">
                                    View
                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
