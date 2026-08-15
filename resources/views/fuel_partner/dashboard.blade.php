<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Fuel Partner Dashboard | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">


    <div class="max-w-7xl mx-auto px-4 py-10">


        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="flex flex-col md:flex-row
                   md:items-center
                   md:justify-between
                   gap-4 mb-8"
        >

            <div>

                <p class="text-gray-500">
                    Fuel Partner
                </p>

                <h1 class="text-3xl font-bold">
                    {{ $partner->company_name }}
                </h1>

            </div>


            <div class="flex flex-wrap gap-3">

                {{-- Fuel Requests --}}

                <a
                    href="{{ route('fuel.partner.requests') }}"
                    class="bg-red-600
                           hover:bg-red-700
                           text-white
                           px-5 py-3
                           rounded-lg
                           font-semibold"
                >
                    Fuel Requests
                </a>


                {{-- Manage Drivers --}}

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


                {{-- Add Driver --}}

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



        {{-- ===================================================== --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ===================================================== --}}

        @if (session('success'))

            <div
                class="bg-green-100
                       border border-green-200
                       text-green-700
                       px-4 py-3
                       rounded-lg
                       mb-6"
            >

                {{ session('success') }}

            </div>

        @endif



        {{-- ===================================================== --}}
        {{-- ERROR MESSAGE --}}
        {{-- ===================================================== --}}

        @if (session('error'))

            <div
                class="bg-red-100
                       border border-red-200
                       text-red-700
                       px-4 py-3
                       rounded-lg
                       mb-6"
            >

                {{ session('error') }}

            </div>

        @endif



        {{-- ===================================================== --}}
        {{-- STATISTICS --}}
        {{-- ===================================================== --}}

        <div
            class="grid
                   grid-cols-1
                   sm:grid-cols-2
                   lg:grid-cols-3
                   xl:grid-cols-6
                   gap-5"
        >


            {{-- Total Requests --}}

            <div
                class="bg-white
                       rounded-xl
                       shadow
                       p-5"
            >

                <p class="text-gray-500 text-sm">
                    Total Requests
                </p>

                <h2
                    class="text-3xl
                           font-bold
                           mt-2"
                >
                    {{ $totalRequests }}
                </h2>

            </div>



            {{-- Pending --}}

            <div
                class="bg-white
                       rounded-xl
                       shadow
                       p-5"
            >

                <p class="text-gray-500 text-sm">
                    Pending
                </p>

                <h2
                    class="text-3xl
                           font-bold
                           mt-2
                           text-yellow-600"
                >
                    {{ $pendingRequests }}
                </h2>

            </div>



            {{-- Completed --}}

            <div
                class="bg-white
                       rounded-xl
                       shadow
                       p-5"
            >

                <p class="text-gray-500 text-sm">
                    Completed
                </p>

                <h2
                    class="text-3xl
                           font-bold
                           mt-2
                           text-green-600"
                >
                    {{ $completedRequests }}
                </h2>

            </div>



            {{-- Revenue --}}

            <div
                class="bg-white
                       rounded-xl
                       shadow
                       p-5"
            >

                <p class="text-gray-500 text-sm">
                    Revenue
                </p>

                <h2
                    class="text-2xl
                           font-bold
                           mt-2"
                >
                    AED
                    {{ number_format(
                        $totalRevenue,
                        2
                    ) }}
                </h2>

            </div>



            {{-- AutoOne Fee --}}

            <div
                class="bg-white
                       rounded-xl
                       shadow
                       p-5"
            >

                <p class="text-gray-500 text-sm">
                    AutoOne Fee
                </p>

                <h2
                    class="text-2xl
                           font-bold
                           text-red-600
                           mt-2"
                >

                    AED
                    {{ number_format(
                        $totalPlatformFee,
                        2
                    ) }}

                </h2>

            </div>



            {{-- Net Earnings --}}

            <div
                class="bg-white
                       rounded-xl
                       shadow
                       p-5"
            >

                <p class="text-gray-500 text-sm">
                    Net Earnings
                </p>

                <h2
                    class="text-2xl
                           font-bold
                           text-green-600
                           mt-2"
                >

                    AED
                    {{ number_format(
                        $netEarnings,
                        2
                    ) }}

                </h2>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- QUICK ACTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="mt-8
                   bg-white
                   rounded-xl
                   shadow
                   p-6"
        >

            <h2
                class="text-xl
                       font-bold
                       mb-5"
            >
                Quick Actions
            </h2>


            <div
                class="flex
                       flex-wrap
                       gap-3"
            >


                {{-- View Requests --}}

                <a
                    href="{{ route(
                        'fuel.partner.requests'
                    ) }}"
                    class="bg-red-600
                           hover:bg-red-700
                           text-white
                           px-5 py-3
                           rounded-lg
                           font-semibold"
                >
                    View Requests
                </a>



                {{-- Manage Drivers --}}

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
                    🚚 Manage Drivers
                </a>



                {{-- Add Driver --}}

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



        {{-- ===================================================== --}}
        {{-- DRIVER MANAGEMENT INFO --}}
        {{-- ===================================================== --}}

        <div
            class="mt-8
                   bg-white
                   rounded-xl
                   shadow
                   p-6"
        >

            <div
                class="flex
                       flex-col
                       md:flex-row
                       md:items-center
                       md:justify-between
                       gap-4"
            >

                <div>

                    <h2
                        class="text-xl
                               font-bold
                               text-gray-900"
                    >
                        Delivery Drivers
                    </h2>

                    <p
                        class="text-gray-500
                               text-sm
                               mt-1"
                    >
                        Add, manage and update your
                        fuel delivery drivers.
                    </p>

                </div>


                <a
                    href="{{ route(
                        'fuel.partner.drivers.index'
                    ) }}"
                    class="text-red-600
                           hover:text-red-700
                           font-semibold"
                >
                    View All Drivers →
                </a>

            </div>


            <div
                class="grid
                       grid-cols-1
                       md:grid-cols-3
                       gap-4
                       mt-6"
            >

                <div
                    class="border
                           rounded-lg
                           p-4"
                >

                    <p
                        class="text-sm
                               text-gray-500"
                    >
                        Driver Management
                    </p>

                    <p
                        class="font-semibold
                               mt-1"
                    >
                        Manage Drivers
                    </p>

                </div>


                <div
                    class="border
                           rounded-lg
                           p-4"
                >

                    <p
                        class="text-sm
                               text-gray-500"
                    >
                        New Driver
                    </p>

                    <p
                        class="font-semibold
                               mt-1"
                    >
                        Add Delivery Driver
                    </p>

                </div>


                <div
                    class="border
                           rounded-lg
                           p-4"
                >

                    <p
                        class="text-sm
                               text-gray-500"
                    >
                        Driver Status
                    </p>

                    <p
                        class="font-semibold
                               mt-1"
                    >
                        Approve / Activate / Suspend
                    </p>

                </div>

            </div>

        </div>


    </div>


</body>

</html>