<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $plan->name }} | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-50">


    <nav class="bg-white border-b">

        <div class="max-w-7xl mx-auto px-4 py-4">

            <a href="{{ url('/') }}" class="text-2xl font-bold">

                AutoOne

            </a>

        </div>

    </nav>


    <main class="max-w-4xl mx-auto
                 px-4 py-12">


        <a href="{{ route('subscriptions.index') }}" class="text-sm text-gray-600 hover:text-black">

            ← Back to VIP Plans

        </a>


        <div
            class="mt-6
                    rounded-2xl
                    bg-white
                    border
                    shadow-lg
                    overflow-hidden">


            <div
                class="bg-gray-900
                        px-8 py-10
                        text-center
                        text-white">

                <div class="text-4xl">
                    👑
                </div>


                <h1 class="mt-3
                           text-3xl
                           font-bold">

                    {{ $plan->name }}

                </h1>


                <p class="mt-2 text-gray-300">

                    {{ $plan->description }}

                </p>

            </div>


            <div class="p-8">


                <div class="text-center">

                    <p class="text-5xl font-bold">

                        {{ number_format($plan->price, 2) }}

                        <span class="text-xl text-gray-500">

                            {{ $plan->currency }}

                        </span>

                    </p>


                    <p class="mt-2 text-gray-500">

                        Valid for
                        {{ $plan->duration_days }}
                        days

                    </p>

                </div>


                <div
                    class="mt-8
                            rounded-xl
                            bg-green-50
                            p-6
                            text-center">

                    <p
                        class="text-4xl
                              font-bold
                              text-green-600">

                        {{ $plan->discount_percentage }}%

                    </p>

                    <p class="text-green-700">

                        General Discount

                    </p>

                </div>


                <div class="mt-8">

                    <h2 class="text-xl font-bold">
                        Benefits
                    </h2>


                    <div
                        class="mt-5
                                grid
                                grid-cols-1
                                md:grid-cols-2
                                gap-4">


                        <div
                            class="rounded-xl
                                    bg-gray-50
                                    p-4">

                            ✓
                            {{ $plan->car_wash_discount }}%
                            Car Wash Discount

                        </div>


                        <div
                            class="rounded-xl
                                    bg-gray-50
                                    p-4">

                            ✓
                            {{ $plan->rental_discount }}%
                            Rental Discount

                        </div>


                        <div
                            class="rounded-xl
                                    bg-gray-50
                                    p-4">

                            ✓
                            {{ $plan->roadside_discount }}%
                            Roadside Discount

                        </div>


                        @if ($plan->priority_booking)
                            <div
                                class="rounded-xl
                                        bg-gray-50
                                        p-4">

                                ✓ Priority Booking

                            </div>
                        @endif


                        @if ($plan->free_inspection)
                            <div
                                class="rounded-xl
                                        bg-gray-50
                                        p-4">

                                ✓ Free Vehicle Inspection

                            </div>
                        @endif

                    </div>

                </div>


                <div class="mt-10">

                    <form method="POST"
                        action="{{ route('subscriptions.subscribe', $plan->id) }}">

                        @csrf

                        <button type="submit"
                            onclick="return confirm(
                                'Are you sure you want to subscribe?'
                            )"
                            class="w-full
                                   rounded-xl
                                   bg-gray-900
                                   px-6 py-4
                                   font-bold
                                   text-white
                                   hover:bg-gray-700">

                            Subscribe to {{ $plan->name }}

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </main>


</body>

</html>
