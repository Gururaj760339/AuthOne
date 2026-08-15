<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        All Deliveries | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">


    <div class="max-w-7xl mx-auto px-4 py-10">


        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div
            class="flex flex-col
               md:flex-row
               md:items-center
               md:justify-between
               gap-4
               mb-8">

            <div>

                <a href="{{ route('fuel.driver.dashboard') }}"
                    class="text-blue-600
                       hover:underline">
                    ← Dashboard
                </a>

                <h1
                    class="text-3xl
                       font-bold
                       text-gray-900
                       mt-2">
                    All Deliveries
                </h1>

                <p class="text-gray-500 mt-1">
                    View and manage your assigned fuel delivery requests.
                </p>

            </div>


            <div>

                <span
                    class="inline-flex
                       bg-blue-100
                       text-blue-700
                       px-4 py-2
                       rounded-full
                       text-sm
                       font-semibold">
                    {{ $deliveries->total() }} Deliveries
                </span>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- SUCCESS --}}
        {{-- ========================================================= --}}

        @if (session('success'))
            <div
                class="bg-green-100
                   border border-green-300
                   text-green-700
                   px-5 py-4
                   rounded-xl
                   mb-6">
                {{ session('success') }}
            </div>
        @endif



        {{-- ========================================================= --}}
        {{-- ERROR --}}
        {{-- ========================================================= --}}

        @if (session('error'))
            <div
                class="bg-red-100
                   border border-red-300
                   text-red-700
                   px-5 py-4
                   rounded-xl
                   mb-6">
                {{ session('error') }}
            </div>
        @endif



        {{-- ========================================================= --}}
        {{-- TABLE --}}
        {{-- ========================================================= --}}

        <div class="bg-white
               rounded-2xl
               shadow
               overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th
                                class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700">
                                Request
                            </th>

                            <th
                                class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700">
                                Customer
                            </th>

                            <th
                                class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700">
                                Fuel
                            </th>

                            <th
                                class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700">
                                Quantity
                            </th>

                            <th
                                class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700">
                                Status
                            </th>

                            <th
                                class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($deliveries as $delivery)
                            <tr class="hover:bg-gray-50">


                                {{-- ID --}}

                                <td class="px-5 py-4
                                   font-semibold">
                                    #{{ $delivery->id }}
                                </td>



                                {{-- CUSTOMER --}}

                                <td class="px-5 py-4">

                                    <div class="font-medium">

                                        {{ $delivery->customer->name ?? 'N/A' }}

                                    </div>

                                    @if ($delivery->customer && $delivery->customer->phone)
                                        <div
                                            class="text-xs
                                           text-gray-500
                                           mt-1">
                                            {{ $delivery->customer->phone }}
                                        </div>
                                    @endif

                                </td>



                                {{-- FUEL --}}

                                <td class="px-5 py-4">

                                    {{ strtoupper(str_replace('_', ' ', $delivery->fuel_type)) }}

                                </td>



                                {{-- QUANTITY --}}

                                <td class="px-5 py-4">

                                    {{ $delivery->requested_quantity }} L

                                </td>



                                {{-- STATUS --}}

                                <td class="px-5 py-4">

                                    @php

                                        $statusClasses = [
                                            'driver_assigned' => 'bg-blue-100 text-blue-700',

                                            'on_the_way' => 'bg-yellow-100 text-yellow-700',

                                            'arrived' => 'bg-purple-100 text-purple-700',

                                            'fuel_delivering' => 'bg-orange-100 text-orange-700',

                                            'completed' => 'bg-green-100 text-green-700',

                                            'cancelled' => 'bg-red-100 text-red-700',

                                            'rejected' => 'bg-red-100 text-red-700',

                                            'failed' => 'bg-red-100 text-red-700',
                                        ];

                                    @endphp


                                    <span
                                        class="inline-flex
                                       px-3 py-1
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       {{ $statusClasses[$delivery->status] ?? 'bg-gray-100 text-gray-700' }}">

                                        {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}

                                    </span>

                                </td>



                                {{-- ACTION --}}

                                <td class="px-5 py-4">

                                    <a href="{{ route('fuel.driver.deliveries.show', $delivery->id) }}"
                                        class="inline-block
                                       bg-blue-600
                                       hover:bg-blue-700
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       text-sm
                                       font-semibold">
                                        View Details
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="px-6 py-16
                                   text-center
                                   text-gray-500">

                                    <div class="text-4xl mb-3">
                                        🚚
                                    </div>

                                    <p
                                        class="text-lg
                                       font-semibold
                                       text-gray-700">
                                        No deliveries found.
                                    </p>

                                    <p class="text-sm mt-1">
                                        Assigned delivery requests will appear here.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- PAGINATION --}}

        <div class="mt-6">

            {{ $deliveries->links() }}

        </div>


    </div>


</body>

</html>
