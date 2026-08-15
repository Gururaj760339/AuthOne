<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Driver Dashboard | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">


    <div class="max-w-7xl mx-auto px-4 py-8">


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

                <p class="text-gray-500 text-sm">
                    Fuel Delivery Driver
                </p>

                <h1
                    class="text-3xl
                       font-bold
                       text-gray-900
                       mt-1">
                    Welcome,
                    {{ $driver->driver_name }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage your assigned fuel deliveries.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <a href="{{ route('fuel.driver.deliveries.index') }}"
                    class="bg-blue-600
               hover:bg-blue-700
               text-white
               px-5 py-3
               rounded-lg
               font-semibold">
                    🚚 All Deliveries
                </a>

            </div>


            {{-- Logout --}}

            <form action="{{ route('user.logout') }}" method="POST">

                @csrf

                <button type="submit"
                    class="bg-gray-800
                       hover:bg-gray-900
                       text-white
                       px-5 py-3
                       rounded-lg
                       font-semibold">
                    Logout
                </button>

            </form>

        </div>



        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
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
        {{-- ERROR MESSAGE --}}
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
        {{-- DRIVER INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="bg-white
               rounded-2xl
               shadow
               p-6
               mb-8">

            <div
                class="flex flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-5">

                <div>

                    <h2 class="text-xl
                           font-bold
                           text-gray-900">
                        Driver Information
                    </h2>

                    <div
                        class="grid
                           grid-cols-1
                           sm:grid-cols-2
                           lg:grid-cols-4
                           gap-5
                           mt-5">

                        {{-- Name --}}

                        <div>

                            <p
                                class="text-xs
                                   uppercase
                                   text-gray-500
                                   font-semibold">
                                Driver Name
                            </p>

                            <p
                                class="font-semibold
                                   text-gray-900
                                   mt-1">
                                {{ $driver->driver_name }}
                            </p>

                        </div>


                        {{-- Phone --}}

                        <div>

                            <p
                                class="text-xs
                                   uppercase
                                   text-gray-500
                                   font-semibold">
                                Phone
                            </p>

                            <p
                                class="font-semibold
                                   text-gray-900
                                   mt-1">
                                {{ $driver->phone ?? 'N/A' }}
                            </p>

                        </div>


                        {{-- Vehicle --}}

                        <div>

                            <p
                                class="text-xs
                                   uppercase
                                   text-gray-500
                                   font-semibold">
                                Vehicle
                            </p>

                            <p
                                class="font-semibold
                                   text-gray-900
                                   mt-1">
                                {{ $driver->vehicle_number ?? 'N/A' }}
                            </p>

                        </div>


                        {{-- Status --}}

                        <div>

                            <p
                                class="text-xs
                                   uppercase
                                   text-gray-500
                                   font-semibold">
                                Driver Status
                            </p>


                            @if ($driver->status === 'active')
                                <span
                                    class="inline-block
                                       bg-green-100
                                       text-green-700
                                       px-3 py-1
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       mt-1">
                                    Active
                                </span>
                            @elseif ($driver->status === 'approved')
                                <span
                                    class="inline-block
                                       bg-blue-100
                                       text-blue-700
                                       px-3 py-1
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       mt-1">
                                    Approved
                                </span>
                            @elseif ($driver->status === 'pending')
                                <span
                                    class="inline-block
                                       bg-yellow-100
                                       text-yellow-700
                                       px-3 py-1
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       mt-1">
                                    Pending
                                </span>
                            @else
                                <span
                                    class="inline-block
                                       bg-red-100
                                       text-red-700
                                       px-3 py-1
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       mt-1">
                                    {{ ucfirst($driver->status) }}
                                </span>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- STATISTICS --}}
        {{-- ========================================================= --}}

        <div
            class="grid
               grid-cols-1
               sm:grid-cols-2
               lg:grid-cols-4
               gap-5
               mb-8">


            {{-- Total Deliveries --}}

            <div class="bg-white
                   rounded-2xl
                   shadow
                   p-6">

                <div class="flex
                       items-center
                       justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Total Deliveries
                        </p>

                        <h2
                            class="text-3xl
                               font-bold
                               text-gray-900
                               mt-2">
                            {{ $totalDeliveries }}
                        </h2>

                    </div>

                    <div
                        class="bg-blue-100
                           text-blue-600
                           w-12 h-12
                           rounded-xl
                           flex
                           items-center
                           justify-center
                           text-xl">
                        🚚
                    </div>

                </div>

            </div>



            {{-- Pending --}}

            <div class="bg-white
                   rounded-2xl
                   shadow
                   p-6">

                <div class="flex
                       items-center
                       justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Pending Deliveries
                        </p>

                        <h2
                            class="text-3xl
                               font-bold
                               text-yellow-600
                               mt-2">
                            {{ $pendingDeliveries }}
                        </h2>

                    </div>

                    <div
                        class="bg-yellow-100
                           text-yellow-600
                           w-12 h-12
                           rounded-xl
                           flex
                           items-center
                           justify-center
                           text-xl">
                        ⏳
                    </div>

                </div>

            </div>



            {{-- Completed --}}

            <div class="bg-white
                   rounded-2xl
                   shadow
                   p-6">

                <div class="flex
                       items-center
                       justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Completed
                        </p>

                        <h2
                            class="text-3xl
                               font-bold
                               text-green-600
                               mt-2">
                            {{ $completedDeliveries }}
                        </h2>

                    </div>

                    <div
                        class="bg-green-100
                           text-green-600
                           w-12 h-12
                           rounded-xl
                           flex
                           items-center
                           justify-center
                           text-xl">
                        ✓
                    </div>

                </div>

            </div>



            {{-- Cancelled --}}

            <div class="bg-white
                   rounded-2xl
                   shadow
                   p-6">

                <div class="flex
                       items-center
                       justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Cancelled
                        </p>

                        <h2
                            class="text-3xl
                               font-bold
                               text-red-600
                               mt-2">
                            {{ $cancelledDeliveries }}
                        </h2>

                    </div>

                    <div
                        class="bg-red-100
                           text-red-600
                           w-12 h-12
                           rounded-xl
                           flex
                           items-center
                           justify-center
                           text-xl">
                        ✕
                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- RECENT DELIVERIES --}}
        {{-- ========================================================= --}}

        <div class="bg-white
               rounded-2xl
               shadow
               overflow-hidden">

            <div
                class="px-6
                   py-5
                   border-b
                   border-gray-200
                   flex
                   flex-col
                   sm:flex-row
                   sm:items-center
                   sm:justify-between
                   gap-3">

                <div>

                    <h2 class="text-xl
                           font-bold
                           text-gray-900">
                        Recent Deliveries
                    </h2>

                    <p class="text-sm
                           text-gray-500
                           mt-1">
                        Your latest assigned fuel deliveries.
                    </p>

                </div>

            </div>



            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th
                                class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-semibold
                                   text-gray-600
                                   uppercase">
                                Request
                            </th>

                            <th
                                class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-semibold
                                   text-gray-600
                                   uppercase">
                                Customer
                            </th>

                            <th
                                class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-semibold
                                   text-gray-600
                                   uppercase">
                                Fuel
                            </th>

                            <th
                                class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-semibold
                                   text-gray-600
                                   uppercase">
                                Quantity
                            </th>

                            <th
                                class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-semibold
                                   text-gray-600
                                   uppercase">
                                Status
                            </th>

                            <th
                                class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-semibold
                                   text-gray-600
                                   uppercase">
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y
                           divide-gray-200">

                        @forelse ($recentDeliveries
                    as $delivery)
                            <tr class="hover:bg-gray-50
                               transition">


                                {{-- Request --}}

                                <td
                                    class="px-6 py-4
                                   font-semibold
                                   text-gray-900">
                                    #{{ $delivery->id }}
                                </td>



                                {{-- Customer --}}

                                <td class="px-6 py-4">

                                    <div class="font-medium
                                       text-gray-900">
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



                                {{-- Fuel --}}

                                <td class="px-6 py-4">

                                    <span class="text-gray-700">

                                        {{ strtoupper(str_replace('_', ' ', $delivery->fuel_type)) }}

                                    </span>

                                </td>



                                {{-- Quantity --}}

                                <td class="px-6 py-4
                                   font-medium">

                                    {{ $delivery->requested_quantity }} L

                                </td>



                                {{-- Status --}}

                                <td class="px-6 py-4">

                                    @if ($delivery->status === 'driver_assigned')
                                        <span
                                            class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-blue-100
                                           text-blue-700
                                           text-xs
                                           font-semibold">
                                            Assigned
                                        </span>
                                    @elseif ($delivery->status === 'on_the_way')
                                        <span
                                            class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-yellow-100
                                           text-yellow-700
                                           text-xs
                                           font-semibold">
                                            On The Way
                                        </span>
                                    @elseif ($delivery->status === 'arrived')
                                        <span
                                            class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-purple-100
                                           text-purple-700
                                           text-xs
                                           font-semibold">
                                            Arrived
                                        </span>
                                    @elseif ($delivery->status === 'completed')
                                        <span
                                            class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-green-100
                                           text-green-700
                                           text-xs
                                           font-semibold">
                                            Completed
                                        </span>
                                    @elseif ($delivery->status === 'cancelled')
                                        <span
                                            class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-red-100
                                           text-red-700
                                           text-xs
                                           font-semibold">
                                            Cancelled
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-gray-100
                                           text-gray-700
                                           text-xs
                                           font-semibold">

                                            {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}

                                        </span>
                                    @endif

                                </td>



                                {{-- Date --}}

                                <td
                                    class="px-6 py-4
                                   text-sm
                                   text-gray-500">

                                    {{ $delivery->created_at->format('d M Y') }}

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-14
                                   text-center">

                                    <div class="text-4xl
                                       mb-3">
                                        🚚
                                    </div>

                                    <p
                                        class="text-lg
                                       font-semibold
                                       text-gray-700">
                                        No deliveries yet
                                    </p>

                                    <p
                                        class="text-sm
                                       text-gray-500
                                       mt-1">
                                        Assigned fuel delivery requests
                                        will appear here.
                                    </p>

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
