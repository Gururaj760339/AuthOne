<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Fuel Requests | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-10">


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="flex flex-col md:flex-row
               md:justify-between
               md:items-center
               gap-4 mb-8"
    >

        <div>

            <a
                href="{{ route('fuel.partner.dashboard') }}"
                class="text-red-600 hover:underline font-medium"
            >
                ← Dashboard
            </a>

            <h1
                class="text-3xl
                       font-bold
                       text-gray-900
                       mt-2"
            >
                Fuel Delivery Requests
            </h1>

            <p class="text-gray-500 mt-1">
                Manage fuel requests and assign your delivery drivers.
            </p>

        </div>


        {{-- Manage Drivers --}}

        <div class="flex flex-wrap gap-3">

            <a
                href="{{ route(
                    'fuel.partner.drivers.index'
                ) }}"
                class="bg-gray-800
                       hover:bg-gray-900
                       text-white
                       px-5 py-3
                       rounded-lg
                       font-semibold"
            >
                Manage Drivers
            </a>


            <a
                href="{{ route(
                    'fuel.partner.drivers.create'
                ) }}"
                class="bg-green-600
                       hover:bg-green-700
                       text-white
                       px-5 py-3
                       rounded-lg
                       font-semibold"
            >
                + Add Driver
            </a>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if (session('success'))

        <div
            class="bg-green-100
                   border border-green-300
                   text-green-700
                   p-4
                   rounded-lg
                   mb-6"
        >

            <div class="flex items-center gap-2">

                <span class="font-bold">
                    ✓
                </span>

                <span>
                    {{ session('success') }}
                </span>

            </div>

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
                   p-4
                   rounded-lg
                   mb-6"
        >

            <div class="flex items-center gap-2">

                <span class="font-bold">
                    !
                </span>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        </div>

    @endif



    {{-- ========================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if ($errors->any())

        <div
            class="bg-red-100
                   border border-red-300
                   text-red-700
                   p-4
                   rounded-lg
                   mb-6"
        >

            <p class="font-bold mb-2">
                Please fix the following errors:
            </p>

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- ========================================================= --}}
    {{-- REQUEST TABLE --}}
    {{-- ========================================================= --}}

    <div
        class="bg-white
               rounded-2xl
               shadow
               overflow-hidden"
    >

        <div class="overflow-x-auto">

            <table class="w-full">


                {{-- ================================================= --}}
                {{-- TABLE HEADER --}}
                {{-- ================================================= --}}

                <thead class="bg-gray-50">

                    <tr>

                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Request
                        </th>


                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Customer
                        </th>


                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Fuel
                        </th>


                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Quantity
                        </th>


                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Total
                        </th>


                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Status
                        </th>


                        <th
                            class="px-5 py-4
                                   text-left
                                   text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Action
                        </th>

                    </tr>

                </thead>



                {{-- ================================================= --}}
                {{-- TABLE BODY --}}
                {{-- ================================================= --}}

                <tbody class="divide-y divide-gray-200">

                @forelse($requests as $request)

                    <tr
                        class="hover:bg-gray-50
                               transition"
                    >


                        {{-- Request ID --}}

                        <td
                            class="px-5 py-4
                                   font-semibold
                                   text-gray-900"
                        >

                            #{{ $request->id }}

                        </td>



                        {{-- Customer --}}

                        <td class="px-5 py-4">

                            <div class="font-medium text-gray-900">

                                {{ $request->customer->name ?? 'N/A' }}

                            </div>

                        </td>



                        {{-- Fuel Type --}}

                        <td class="px-5 py-4">

                            <span class="text-gray-700">

                                {{
                                    strtoupper(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $request->fuel_type
                                        )
                                    )
                                }}

                            </span>

                        </td>



                        {{-- Quantity --}}

                        <td class="px-5 py-4">

                            <span
                                class="font-medium
                                       text-gray-800"
                            >

                                {{ $request->requested_quantity }} L

                            </span>

                        </td>



                        {{-- Total --}}

                        <td
                            class="px-5 py-4
                                   font-semibold
                                   text-gray-900"
                        >

                            AED
                            {{ number_format(
                                $request->total_amount,
                                2
                            ) }}

                        </td>



                        {{-- ================================================= --}}
                        {{-- STATUS --}}
                        {{-- ================================================= --}}

                        <td class="px-5 py-4">

                            @if ($request->status === 'searching')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-yellow-100
                                           text-yellow-700
                                           text-xs
                                           font-semibold"
                                >
                                    Searching
                                </span>


                            @elseif ($request->status === 'accepted')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-green-100
                                           text-green-700
                                           text-xs
                                           font-semibold"
                                >
                                    Accepted
                                </span>


                            @elseif ($request->status === 'driver_assigned')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-blue-100
                                           text-blue-700
                                           text-xs
                                           font-semibold"
                                >
                                    Driver Assigned
                                </span>


                            @elseif ($request->status === 'completed')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-green-100
                                           text-green-700
                                           text-xs
                                           font-semibold"
                                >
                                    Completed
                                </span>


                            @elseif ($request->status === 'rejected')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-red-100
                                           text-red-700
                                           text-xs
                                           font-semibold"
                                >
                                    Rejected
                                </span>


                            @else

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           bg-gray-100
                                           text-gray-700
                                           text-xs
                                           font-semibold"
                                >

                                    {{
                                        ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $request->status
                                            )
                                        )
                                    }}

                                </span>

                            @endif

                        </td>



                        {{-- ================================================= --}}
                        {{-- ACTION --}}
                        {{-- ================================================= --}}

                        <td class="px-5 py-4">


                            {{-- ============================================= --}}
                            {{-- SEARCHING --}}
                            {{-- ============================================= --}}

                            @if ($request->status === 'searching')

                                <div class="flex gap-2">

                                    {{-- ACCEPT --}}

                                    <form
                                        action="{{ route(
                                            'fuel.partner.requests.accept',
                                            $request->id
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-green-600
                                                   hover:bg-green-700
                                                   text-white
                                                   px-3 py-2
                                                   rounded-lg
                                                   text-sm
                                                   font-semibold"
                                        >
                                            Accept
                                        </button>

                                    </form>


                                    {{-- REJECT --}}

                                    <form
                                        action="{{ route(
                                            'fuel.partner.requests.reject',
                                            $request->id
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-red-600
                                                   hover:bg-red-700
                                                   text-white
                                                   px-3 py-2
                                                   rounded-lg
                                                   text-sm
                                                   font-semibold"
                                        >
                                            Reject
                                        </button>

                                    </form>

                                </div>


                            {{-- ============================================= --}}
                            {{-- ACCEPTED --}}
                            {{-- ============================================= --}}

                            @elseif ($request->status === 'accepted')


                                @if ($drivers->count() > 0)

                                    <div class="min-w-[250px]">

                                        <form
                                            action="{{ route(
                                                'fuel.partner.requests.assign-driver',
                                                $request->id
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf


                                            <label
                                                class="block
                                                       text-xs
                                                       font-semibold
                                                       text-gray-600
                                                       mb-2"
                                            >
                                                Assign Delivery Driver
                                            </label>


                                            <div class="flex gap-2">


                                                {{-- DRIVER SELECT --}}

                                                <select
                                                    name="driver_id"
                                                    required
                                                    class="border
                                                           border-gray-300
                                                           rounded-lg
                                                           px-3 py-2
                                                           text-sm
                                                           w-full
                                                           bg-white
                                                           focus:outline-none
                                                           focus:ring-2
                                                           focus:ring-blue-500"
                                                >

                                                    <option value="">
                                                        Select Driver
                                                    </option>


                                                    @foreach($drivers as $driver)

                                                        <option
                                                            value="{{ $driver->user_id }}"
                                                        >

                                                            {{ $driver->driver_name }}

                                                            @if(
                                                                $driver->vehicle_number
                                                            )

                                                                -
                                                                {{ $driver->vehicle_number }}

                                                            @endif

                                                        </option>

                                                    @endforeach

                                                </select>


                                                {{-- ASSIGN BUTTON --}}

                                                <button
                                                    type="submit"
                                                    class="bg-blue-600
                                                           hover:bg-blue-700
                                                           text-white
                                                           px-3 py-2
                                                           rounded-lg
                                                           text-sm
                                                           font-semibold
                                                           whitespace-nowrap"
                                                >
                                                    Assign
                                                </button>

                                            </div>

                                        </form>

                                    </div>


                                @else

                                    {{-- NO DRIVER --}}

                                    <div
                                        class="min-w-[200px]"
                                    >

                                        <p
                                            class="text-sm
                                                   text-red-600
                                                   font-semibold
                                                   mb-2"
                                        >
                                            No active driver available.
                                        </p>


                                        <a
                                            href="{{ route(
                                                'fuel.partner.drivers.create'
                                            ) }}"
                                            class="inline-block
                                                   bg-green-600
                                                   hover:bg-green-700
                                                   text-white
                                                   px-3 py-2
                                                   rounded-lg
                                                   text-sm
                                                   font-semibold"
                                        >
                                            + Add Driver
                                        </a>

                                    </div>

                                @endif



                            {{-- ============================================= --}}
                            {{-- DRIVER ASSIGNED --}}
                            {{-- ============================================= --}}

                            @elseif (
                                $request->status === 'driver_assigned'
                            )

                                <div>

                                    <span
                                        class="inline-flex
                                               bg-blue-100
                                               text-blue-700
                                               px-3 py-1
                                               rounded-full
                                               text-xs
                                               font-semibold"
                                    >
                                        Driver Assigned
                                    </span>


                                    @if ($request->driver)

                                        <p
                                            class="text-sm
                                                   text-gray-600
                                                   mt-2"
                                        >

                                            Driver:

                                            <strong
                                                class="text-gray-900"
                                            >
                                                {{ $request->driver->name }}
                                            </strong>

                                        </p>

                                    @endif

                                </div>



                            {{-- ============================================= --}}
                            {{-- COMPLETED --}}
                            {{-- ============================================= --}}

                            @elseif ($request->status === 'completed')

                                <span
                                    class="text-green-700
                                           font-semibold"
                                >
                                    Completed
                                </span>



                            {{-- ============================================= --}}
                            {{-- REJECTED --}}
                            {{-- ============================================= --}}

                            @elseif ($request->status === 'rejected')

                                <span
                                    class="text-red-600
                                           font-semibold"
                                >
                                    Rejected
                                </span>



                            {{-- ============================================= --}}
                            {{-- OTHER --}}
                            {{-- ============================================= --}}

                            @else

                                <span class="text-gray-500">

                                    No Action

                                </span>

                            @endif

                        </td>

                    </tr>


                @empty


                    {{-- ================================================= --}}
                    {{-- NO REQUEST --}}
                    {{-- ================================================= --}}

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-16
                                   text-center
                                   text-gray-500"
                        >

                            <div class="text-4xl mb-3">
                                ⛽
                            </div>

                            <p
                                class="text-lg
                                       font-semibold
                                       text-gray-700"
                            >
                                No fuel delivery requests found.
                            </p>

                            <p
                                class="text-sm
                                       text-gray-500
                                       mt-1"
                            >
                                New customer fuel requests will
                                appear here.
                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- PAGINATION --}}
    {{-- ========================================================= --}}

    <div class="mt-6">

        {{ $requests->links() }}

    </div>


</div>


</body>

</html>