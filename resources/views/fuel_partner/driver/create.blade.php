<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Add Delivery Driver | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">


<div class="max-w-4xl mx-auto px-4 py-10">


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

            <h1
                class="text-3xl
                       font-bold
                       text-gray-900"
            >
                Add Delivery Driver
            </h1>

            <p class="text-gray-500 mt-1">
                Create a driver account and delivery profile.
            </p>

        </div>


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
            ← Back to Drivers
        </a>

    </div>



    {{-- ===================================================== --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ===================================================== --}}

    @if ($errors->any())

        <div
            class="bg-red-100
                   border border-red-300
                   text-red-700
                   px-5 py-4
                   rounded-xl
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



    {{-- ===================================================== --}}
    {{-- CREATE DRIVER FORM --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route(
            'fuel.partner.drivers.store'
        ) }}"
        method="POST"
        class="bg-white
               rounded-2xl
               shadow
               p-6 md:p-8"
    >

        @csrf


        {{-- ================================================= --}}
        {{-- USER ACCOUNT --}}
        {{-- ================================================= --}}

        <div class="mb-8">

            <h2
                class="text-xl
                       font-bold
                       text-gray-900
                       mb-1"
            >
                User Account Information
            </h2>

            <p
                class="text-sm
                       text-gray-500
                       mb-5"
            >
                These details will be used by the driver
                to log in to AutoOne.
            </p>


            <div
                class="grid
                       grid-cols-1
                       md:grid-cols-2
                       gap-5"
            >


                {{-- Driver Name --}}

                <div class="md:col-span-2">

                    <label
                        for="driver_name"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Driver Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="driver_name"
                        name="driver_name"
                        value="{{ old('driver_name') }}"
                        required
                        placeholder="Enter driver name"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- Email --}}

                <div>

                    <label
                        for="email"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Email Address
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="driver@example.com"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- Phone --}}

                <div>

                    <label
                        for="phone"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Phone Number
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        required
                        placeholder="+971 50 123 4567"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- Password --}}

                <div>

                    <label
                        for="password"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Password
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Minimum 6 characters"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- Confirm Password --}}

                <div>

                    <label
                        for="password_confirmation"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Confirm Password
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        placeholder="Confirm password"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- DRIVER INFORMATION --}}
        {{-- ================================================= --}}

        <div class="border-t pt-8">

            <h2
                class="text-xl
                       font-bold
                       text-gray-900
                       mb-1"
            >
                Driver Information
            </h2>

            <p
                class="text-sm
                       text-gray-500
                       mb-5"
            >
                Enter the driver's license and identification
                information.
            </p>


            <div
                class="grid
                       grid-cols-1
                       md:grid-cols-2
                       gap-5"
            >


                {{-- License Number --}}

                <div>

                    <label
                        for="license_number"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        License Number
                    </label>

                    <input
                        type="text"
                        id="license_number"
                        name="license_number"
                        value="{{ old(
                            'license_number'
                        ) }}"
                        placeholder="Enter license number"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- License Expiry --}}

                <div>

                    <label
                        for="license_expiry"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        License Expiry
                    </label>

                    <input
                        type="date"
                        id="license_expiry"
                        name="license_expiry"
                        value="{{ old(
                            'license_expiry'
                        ) }}"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- National ID --}}

                <div>

                    <label
                        for="national_id"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        National ID
                    </label>

                    <input
                        type="text"
                        id="national_id"
                        name="national_id"
                        value="{{ old(
                            'national_id'
                        ) }}"
                        placeholder="Enter national ID"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- Vehicle Number --}}

                <div>

                    <label
                        for="vehicle_number"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Vehicle Number
                    </label>

                    <input
                        type="text"
                        id="vehicle_number"
                        name="vehicle_number"
                        value="{{ old(
                            'vehicle_number'
                        ) }}"
                        placeholder="e.g. DXB-12345"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                </div>



                {{-- Vehicle Type --}}

                <div class="md:col-span-2">

                    <label
                        for="vehicle_type"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Vehicle Type
                    </label>

                    <select
                        id="vehicle_type"
                        name="vehicle_type"
                        class="w-full
                               border
                               border-gray-300
                               rounded-lg
                               px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-red-500"
                    >

                        <option value="">
                            Select Vehicle Type
                        </option>

                        <option
                            value="van"
                            @selected(
                                old(
                                    'vehicle_type'
                                ) === 'van'
                            )
                        >
                            Van
                        </option>

                        <option
                            value="pickup"
                            @selected(
                                old(
                                    'vehicle_type'
                                ) === 'pickup'
                            )
                        >
                            Pickup
                        </option>

                        <option
                            value="truck"
                            @selected(
                                old(
                                    'vehicle_type'
                                ) === 'truck'
                            )
                        >
                            Truck
                        </option>

                        <option
                            value="tanker"
                            @selected(
                                old(
                                    'vehicle_type'
                                ) === 'tanker'
                            )
                        >
                            Fuel Tanker
                        </option>

                        <option
                            value="other"
                            @selected(
                                old(
                                    'vehicle_type'
                                ) === 'other'
                            )
                        >
                            Other
                        </option>

                    </select>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- INFORMATION --}}
        {{-- ================================================= --}}

        <div
            class="mt-8
                   bg-yellow-50
                   border
                   border-yellow-200
                   text-yellow-800
                   rounded-lg
                   px-4 py-3"
        >

            <p class="text-sm">

                <strong>Driver Status:</strong>
                New drivers will be created with
                <strong>Pending</strong> status.

            </p>

            <p class="text-sm mt-1">

                The driver's login role will automatically
                be set to
                <strong>fuel_driver</strong>.

            </p>

        </div>



        {{-- ================================================= --}}
        {{-- BUTTONS --}}
        {{-- ================================================= --}}

        <div
            class="flex
                   flex-col-reverse
                   sm:flex-row
                   sm:justify-end
                   gap-3
                   mt-8"
        >

            <a
                href="{{ route(
                    'fuel.partner.drivers.index'
                ) }}"
                class="text-center
                       border
                       border-gray-300
                       px-6 py-3
                       rounded-lg
                       font-semibold
                       hover:bg-gray-50"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="bg-green-600
                       hover:bg-green-700
                       text-white
                       px-6 py-3
                       rounded-lg
                       font-semibold"
            >
                Create Driver
            </button>

        </div>

    </form>

</div>


</body>

</html>