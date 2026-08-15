<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Fuel Request #{{ $fuelRequest->id }} | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto px-4 py-10">

        <div class="mb-6">

            <a href="{{ route('fuel.delivery.my') }}" class="text-red-600 hover:underline">
                ← My Fuel Requests
            </a>

        </div>


        <div class="bg-white rounded-2xl shadow p-6 md:p-8">

            <div
                class="flex flex-col md:flex-row
                    md:justify-between
                    md:items-center
                    gap-4 mb-8">

                <div>

                    <p class="text-gray-500">
                        Fuel Request
                    </p>

                    <h1 class="text-3xl font-bold">
                        #{{ $fuelRequest->id }}
                    </h1>

                </div>


                <span class="px-4 py-2 rounded-full
                       bg-gray-100 font-semibold">
                    {{ ucfirst(str_replace('_', ' ', $fuelRequest->status)) }}
                </span>

            </div>


            <div class="grid md:grid-cols-2 gap-6">


                {{-- Fuel --}}
                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Fuel Type
                    </p>

                    <h3 class="text-xl font-bold mt-1">

                        {{ strtoupper(str_replace('_', ' ', $fuelRequest->fuel_type)) }}

                    </h3>

                </div>


                {{-- Quantity --}}
                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Requested Quantity
                    </p>

                    <h3 class="text-xl font-bold mt-1">

                        {{ $fuelRequest->requested_quantity }} L

                    </h3>

                </div>


                {{-- Partner --}}
                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Fuel Partner
                    </p>

                    <h3 class="text-xl font-bold mt-1">

                        {{ $fuelRequest->partner->company_name ?? 'Searching...' }}

                    </h3>

                </div>


                {{-- Driver --}}
                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Driver
                    </p>

                    <h3 class="text-xl font-bold mt-1">

                        {{ $fuelRequest->driver->name ?? 'Not Assigned' }}

                    </h3>

                </div>

            </div>


            {{-- Address --}}

            <div class="mt-6 border rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Delivery Address
                </p>

                <p class="font-semibold mt-1">

                    {{ $fuelRequest->delivery_address }}

                </p>

            </div>


            {{-- OTP --}}

            @if (in_array($fuelRequest->status, ['driver_assigned', 'on_the_way', 'arrived', 'fuel_delivering']))
                <div
                    class="mt-6 bg-yellow-50
                       border border-yellow-300
                       rounded-xl p-6 text-center">

                    <p class="text-gray-600">
                        Delivery OTP
                    </p>

                    <h2
                        class="text-4xl font-bold
                           tracking-widest
                           text-red-600 mt-2">
                        {{ $fuelRequest->otp }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Share this OTP with the driver
                        when required.
                    </p>

                </div>
            @endif


            {{-- Price --}}

            <div class="mt-8 border-t pt-6">

                <h2 class="text-xl font-bold mb-4">
                    Payment Summary
                </h2>


                <div class="space-y-3">

                    <div class="flex justify-between">

                        <span>
                            Fuel Cost
                        </span>

                        <span>
                            AED
                            {{ number_format($fuelRequest->fuel_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span>
                            Delivery Fee
                        </span>

                        <span>
                            AED
                            {{ number_format($fuelRequest->delivery_fee, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span>
                            Emergency Fee
                        </span>

                        <span>
                            AED
                            {{ number_format($fuelRequest->emergency_fee, 2) }}
                        </span>

                    </div>


                    <div
                        class="border-t pt-3
                           flex justify-between
                           text-xl font-bold">

                        <span>
                            Total
                        </span>

                        <span class="text-red-600">

                            AED
                            {{ number_format($fuelRequest->total_amount, 2) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
