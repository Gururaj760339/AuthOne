<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Delivery #{{ $delivery->id }} | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="mb-8">

        <a
            href="{{ route('fuel.driver.deliveries.index') }}"
            class="text-blue-600 hover:underline"
        >
            ← All Deliveries
        </a>

        <h1 class="text-3xl font-bold text-gray-900 mt-2">
            Delivery Request #{{ $delivery->id }}
        </h1>

    </div>


    {{-- ========================================================= --}}
    {{-- MESSAGES --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div
            class="bg-green-100
                   border border-green-300
                   text-green-700
                   px-5 py-4
                   rounded-xl
                   mb-6"
        >
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div
            class="bg-red-100
                   border border-red-300
                   text-red-700
                   px-5 py-4
                   rounded-xl
                   mb-6"
        >
            {{ session('error') }}
        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if($errors->any())

        <div
            class="bg-red-50
                   border border-red-200
                   text-red-700
                   px-5 py-4
                   rounded-xl
                   mb-6"
        >

            <ul class="list-disc pl-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- STATUS CARD --}}
    {{-- ========================================================= --}}

    <div
        class="bg-white
               rounded-2xl
               shadow
               p-6
               mb-6"
    >

        <div
            class="flex flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-5"
        >

            {{-- CURRENT STATUS --}}

            <div>

                <p class="text-sm text-gray-500">
                    Current Status
                </p>


                @php

                    $statusClasses = [

                        'driver_assigned' =>
                            'bg-blue-100 text-blue-700',

                        'on_the_way' =>
                            'bg-yellow-100 text-yellow-700',

                        'arrived' =>
                            'bg-purple-100 text-purple-700',

                        'fuel_delivering' =>
                            'bg-orange-100 text-orange-700',

                        'completed' =>
                            'bg-green-100 text-green-700',

                        'cancelled' =>
                            'bg-red-100 text-red-700',

                        'rejected' =>
                            'bg-red-100 text-red-700',

                        'failed' =>
                            'bg-red-100 text-red-700',

                    ];

                @endphp


                <span
                    class="
                        inline-flex
                        mt-2
                        px-4 py-2
                        rounded-full
                        text-sm
                        font-bold
                        {{ $statusClasses[$delivery->status]
                            ?? 'bg-gray-100 text-gray-700' }}
                    "
                >

                    {{ ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $delivery->status
                        )
                    ) }}

                </span>

            </div>


            {{-- ================================================= --}}
            {{-- DRIVER ACTIONS --}}
            {{-- ================================================= --}}

            <div class="flex flex-wrap gap-3">


                {{-- ================================================= --}}
                {{-- DRIVER ASSIGNED --}}
                {{-- ================================================= --}}

                @if($delivery->status === 'driver_assigned')

                    {{-- START DELIVERY --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="on_the_way"
                        >

                        <button
                            type="submit"
                            class="
                                bg-blue-600
                                hover:bg-blue-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                                shadow
                            "
                        >
                            🚚 Start Delivery
                        </button>

                    </form>


                    {{-- FAILED --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="failed"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure this delivery failed?'
                            )"
                            class="
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                            "
                        >
                            ✕ Failed
                        </button>

                    </form>

                @endif


                {{-- ================================================= --}}
                {{-- ON THE WAY --}}
                {{-- ================================================= --}}

                @if($delivery->status === 'on_the_way')

                    {{-- ARRIVED --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="arrived"
                        >

                        <button
                            type="submit"
                            class="
                                bg-purple-600
                                hover:bg-purple-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                                shadow
                            "
                        >
                            📍 Mark Arrived
                        </button>

                    </form>


                    {{-- CANCEL --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="cancelled"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure you want to cancel this delivery?'
                            )"
                            class="
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                            "
                        >
                            ✕ Cancel
                        </button>

                    </form>


                    {{-- FAILED --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="failed"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure this delivery failed?'
                            )"
                            class="
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                            "
                        >
                            ✕ Failed
                        </button>

                    </form>

                @endif


                {{-- ================================================= --}}
                {{-- ARRIVED --}}
                {{-- ================================================= --}}

                @if($delivery->status === 'arrived')

                    {{-- START FUEL DELIVERY --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="fuel_delivering"
                        >

                        <button
                            type="submit"
                            class="
                                bg-orange-600
                                hover:bg-orange-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                                shadow
                            "
                        >
                            ⛽ Start Fuel Delivery
                        </button>

                    </form>


                    {{-- CANCEL --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="cancelled"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure you want to cancel this delivery?'
                            )"
                            class="
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                            "
                        >
                            ✕ Cancel
                        </button>

                    </form>


                    {{-- FAILED --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="failed"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure this delivery failed?'
                            )"
                            class="
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                            "
                        >
                            ✕ Failed
                        </button>

                    </form>

                @endif


                {{-- ================================================= --}}
                {{-- FUEL DELIVERING --}}
                {{-- ================================================= --}}

                @if($delivery->status === 'fuel_delivering')

                    {{-- COMPLETE DELIVERY --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="completed"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure the fuel delivery is completed?'
                            )"
                            class="
                                bg-green-600
                                hover:bg-green-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                                shadow
                            "
                        >
                            ✓ Complete Delivery
                        </button>

                    </form>


                    {{-- FAILED --}}

                    <form
                        action="{{ route(
                            'fuel.driver.deliveries.status',
                            $delivery->id
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="failed"
                        >

                        <button
                            type="submit"
                            onclick="return confirm(
                                'Are you sure this delivery failed?'
                            )"
                            class="
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                px-5 py-3
                                rounded-lg
                                font-semibold
                            "
                        >
                            ✕ Failed
                        </button>

                    </form>

                @endif


            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CUSTOMER INFORMATION --}}
    {{-- ========================================================= --}}

    <div
        class="bg-white
               rounded-2xl
               shadow
               p-6
               mb-6"
    >

        <h2 class="text-xl font-bold text-gray-900 mb-5">
            Customer Information
        </h2>


        <div
            class="grid
                   grid-cols-1
                   md:grid-cols-2
                   gap-6"
        >

            <div>

                <p class="text-sm text-gray-500">
                    Customer Name
                </p>

                <p class="font-semibold text-gray-900 mt-1">
                    {{ $delivery->customer->name ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-sm text-gray-500">
                    Phone
                </p>

                <p class="font-semibold text-gray-900 mt-1">
                    {{ $delivery->customer->phone ?? 'N/A' }}
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- FUEL INFORMATION --}}
    {{-- ========================================================= --}}

    <div
        class="bg-white
               rounded-2xl
               shadow
               p-6
               mb-6"
    >

        <h2 class="text-xl font-bold text-gray-900 mb-5">
            Fuel Information
        </h2>


        <div
            class="grid
                   grid-cols-1
                   sm:grid-cols-2
                   lg:grid-cols-3
                   gap-6"
        >

            <div>

                <p class="text-sm text-gray-500">
                    Fuel Type
                </p>

                <p class="font-semibold text-gray-900 mt-1">

                    {{ strtoupper(
                        str_replace(
                            '_',
                            ' ',
                            $delivery->fuel_type
                        )
                    ) }}

                </p>

            </div>


            <div>

                <p class="text-sm text-gray-500">
                    Requested Quantity
                </p>

                <p class="font-semibold text-gray-900 mt-1">
                    {{ $delivery->requested_quantity }} L
                </p>

            </div>


            <div>

                <p class="text-sm text-gray-500">
                    Total Amount
                </p>

                <p class="font-semibold text-gray-900 mt-1">

                    AED
                    {{ number_format(
                        $delivery->total_amount,
                        2
                    ) }}

                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- DELIVERY INFORMATION --}}
    {{-- ========================================================= --}}

    <div
        class="bg-white
               rounded-2xl
               shadow
               p-6
               mb-6"
    >

        <h2 class="text-xl font-bold text-gray-900 mb-5">
            Delivery Information
        </h2>


        <div class="space-y-5">

            @if($delivery->delivery_address)

                <div>

                    <p class="text-sm text-gray-500">
                        Delivery Address
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        {{ $delivery->delivery_address }}
                    </p>

                </div>

            @endif


            @if($delivery->notes)

                <div>

                    <p class="text-sm text-gray-500">
                        Customer Notes
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        {{ $delivery->notes }}
                    </p>

                </div>

            @else

                <div>

                    <p class="text-sm text-gray-500">
                        Customer Notes
                    </p>

                    <p class="text-gray-500 mt-1">
                        No notes
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TERMINAL STATUS --}}
    {{-- ========================================================= --}}

    @if(
        in_array(
            $delivery->status,
            [
                'completed',
                'cancelled',
                'rejected',
                'failed'
            ]
        )
    )

        <div
            class="
                rounded-2xl
                p-6
                @if($delivery->status === 'completed')
                    bg-green-50 border border-green-200
                @else
                    bg-red-50 border border-red-200
                @endif
            "
        >

            @if($delivery->status === 'completed')

                <h2 class="font-bold text-green-700 text-lg">
                    ✓ Delivery Completed
                </h2>

                <p class="text-green-600 text-sm mt-1">
                    This fuel delivery has been successfully completed.
                </p>

            @else

                <h2 class="font-bold text-red-700 text-lg">

                    Delivery
                    {{ ucfirst($delivery->status) }}

                </h2>

                <p class="text-red-600 text-sm mt-1">
                    No further status updates are available.
                </p>

            @endif

        </div>

    @endif


</div>

</body>

</html>