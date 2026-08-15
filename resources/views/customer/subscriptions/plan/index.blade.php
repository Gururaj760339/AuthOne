<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VIP Membership | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- Navbar --}}
    <nav class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

            <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900">
                AutoOne
            </a>

            <div class="flex items-center gap-4">

                <a href="{{ route('subscriptions.index') }}" class="text-gray-700 hover:text-black">
                    VIP Membership
                </a>

                <a href="{{ route('subscriptions.my') }}" class="text-gray-700 hover:text-black">
                    My Membership
                </a>

            </div>

        </div>
    </nav>


    <main class="max-w-7xl mx-auto px-4 py-12">

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="mb-8 rounded-xl bg-green-100
                        border border-green-200
                        px-5 py-4 text-green-700">

                {{ session('success') }}

            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div
                class="mb-8 rounded-xl bg-red-100
                        border border-red-200
                        px-5 py-4 text-red-700">

                {{ session('error') }}

            </div>
        @endif


        {{-- Page Header --}}
        <div class="text-center mb-12">

            <div
                class="inline-flex items-center justify-center
                        w-16 h-16 rounded-full
                        bg-yellow-100 mb-5">

                <span class="text-3xl">
                    👑
                </span>

            </div>

            <h1 class="text-4xl md:text-5xl font-bold">
                AutoOne VIP Membership
            </h1>

            <p class="mt-4 max-w-2xl mx-auto
                      text-gray-600 text-lg">

                Save money on vehicle services with exclusive
                VIP discounts and premium benefits.

            </p>

        </div>


        {{-- Active Subscription --}}
        @if ($activeSubscription)
            <div
                class="mb-12 overflow-hidden
                        rounded-2xl
                        bg-gradient-to-r
                        from-yellow-400
                        to-orange-400
                        shadow-lg">

                <div class="p-6 md:p-8">

                    <div
                        class="flex flex-col md:flex-row
                                md:items-center
                                md:justify-between
                                gap-6">

                        <div>

                            <div class="flex items-center gap-3">

                                <span class="text-3xl">
                                    👑
                                </span>

                                <span
                                    class="inline-flex
                                             rounded-full
                                             bg-green-600
                                             px-3 py-1
                                             text-xs
                                             font-bold
                                             text-white">

                                    ACTIVE

                                </span>

                            </div>


                            <h2 class="mt-3 text-3xl font-bold">

                                {{ $activeSubscription->plan->name }}

                            </h2>


                            <p class="mt-2 text-gray-800">

                                You are currently enjoying
                                {{ $activeSubscription->plan->discount_percentage }}%
                                VIP discount.

                            </p>

                        </div>


                        <div
                            class="bg-white/80
                                    rounded-xl
                                    px-6 py-5">

                            <p class="text-sm text-gray-600">
                                Membership expires
                            </p>

                            <p class="mt-1 text-xl font-bold">

                                {{ $activeSubscription->ends_at->format('d M Y') }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>
        @endif


        {{-- Plans --}}
        <div
            class="grid grid-cols-1
                    md:grid-cols-2
                    lg:grid-cols-3
                    gap-8">

            @forelse($plans as $plan)
                <div
                    class="relative flex flex-col
                            rounded-2xl
                            bg-white
                            border border-gray-200
                            shadow-lg
                            overflow-hidden
                            hover:shadow-2xl
                            transition duration-300">


                    {{-- Popular Badge --}}
                    @if ($plan->slug === 'vip-gold')
                        <div class="absolute top-0 right-0">

                            <div
                                class="rounded-bl-xl
                                        bg-yellow-400
                                        px-4 py-2
                                        text-sm
                                        font-bold">

                                MOST POPULAR

                            </div>

                        </div>
                    @endif


                    {{-- Plan Header --}}
                    <div class="p-7 text-center
                                border-b">

                        <h2 class="text-2xl font-bold">

                            {{ $plan->name }}

                        </h2>


                        <p class="mt-2 text-gray-500 min-h-[48px]">

                            {{ $plan->description }}

                        </p>


                        <div class="mt-6">

                            <span class="text-5xl font-bold">

                                {{ number_format($plan->price, 2) }}

                            </span>

                            <span class="text-gray-500">

                                {{ $plan->currency }}

                            </span>

                        </div>


                        <p class="mt-2 text-sm text-gray-500">

                            Valid for {{ $plan->duration_days }} days

                        </p>

                    </div>


                    {{-- Discount --}}
                    <div
                        class="mx-6 mt-6
                                rounded-xl
                                bg-green-50
                                border border-green-100
                                p-5
                                text-center">

                        <p class="text-4xl font-bold text-green-600">

                            {{ $plan->discount_percentage }}%

                        </p>

                        <p class="mt-1 text-sm
                                  text-green-700">

                            General Service Discount

                        </p>

                    </div>


                    {{-- Benefits --}}
                    <div class="flex-1 p-7">

                        <h3 class="font-bold text-lg mb-5">
                            Membership Benefits
                        </h3>


                        <ul class="space-y-4">

                            {{-- General Discount --}}
                            <li class="flex items-start gap-3">

                                <span
                                    class="flex-shrink-0
                                             flex items-center
                                             justify-center
                                             w-6 h-6
                                             rounded-full
                                             bg-green-100
                                             text-green-600">

                                    ✓

                                </span>

                                <span class="text-gray-700">

                                    {{ $plan->discount_percentage }}%
                                    general service discount

                                </span>

                            </li>


                            {{-- Car Wash --}}
                            <li class="flex items-start gap-3">

                                <span
                                    class="flex-shrink-0
                                             flex items-center
                                             justify-center
                                             w-6 h-6
                                             rounded-full
                                             bg-green-100
                                             text-green-600">

                                    ✓

                                </span>

                                <span class="text-gray-700">

                                    {{ $plan->car_wash_discount }}%
                                    car wash discount

                                </span>

                            </li>


                            {{-- Rental --}}
                            <li class="flex items-start gap-3">

                                <span
                                    class="flex-shrink-0
                                             flex items-center
                                             justify-center
                                             w-6 h-6
                                             rounded-full
                                             bg-green-100
                                             text-green-600">

                                    ✓

                                </span>

                                <span class="text-gray-700">

                                    {{ $plan->rental_discount }}%
                                    car rental discount

                                </span>

                            </li>


                            {{-- Roadside --}}
                            <li class="flex items-start gap-3">

                                <span
                                    class="flex-shrink-0
                                             flex items-center
                                             justify-center
                                             w-6 h-6
                                             rounded-full
                                             bg-green-100
                                             text-green-600">

                                    ✓

                                </span>

                                <span class="text-gray-700">

                                    {{ $plan->roadside_discount }}%
                                    roadside assistance discount

                                </span>

                            </li>


                            {{-- Priority Booking --}}
                            @if ($plan->priority_booking)
                                <li class="flex items-start gap-3">

                                    <span
                                        class="flex-shrink-0
                                                 flex items-center
                                                 justify-center
                                                 w-6 h-6
                                                 rounded-full
                                                 bg-green-100
                                                 text-green-600">

                                        ✓

                                    </span>

                                    <span class="text-gray-700">

                                        Priority booking

                                    </span>

                                </li>
                            @endif


                            {{-- Free Inspection --}}
                            @if ($plan->free_inspection)
                                <li class="flex items-start gap-3">

                                    <span
                                        class="flex-shrink-0
                                                 flex items-center
                                                 justify-center
                                                 w-6 h-6
                                                 rounded-full
                                                 bg-green-100
                                                 text-green-600">

                                        ✓

                                    </span>

                                    <span class="text-gray-700">

                                        Free vehicle inspection

                                    </span>

                                </li>
                            @endif

                        </ul>

                    </div>


                    {{-- Button --}}
                    <div class="p-7 pt-0">

                        @if ($activeSubscription)
                            <button type="button" disabled
                                class="w-full rounded-xl
                                       bg-gray-200
                                       px-5 py-3.5
                                       font-semibold
                                       text-gray-500
                                       cursor-not-allowed">

                                Already Subscribed

                            </button>
                        @else
                            <form method="POST"
                                action="{{ route('subscriptions.subscribe', $plan->id) }}">

                                @csrf

                                <button type="submit"
                                    onclick="return confirm(
                                        'Are you sure you want to subscribe to this VIP plan?'
                                    )"
                                    class="w-full rounded-xl
                                           bg-gray-900
                                           px-5 py-3.5
                                           font-semibold
                                           text-white
                                           hover:bg-gray-700
                                           transition">

                                    Subscribe Now

                                </button>

                            </form>
                        @endif

                    </div>

                </div>

            @empty

                <div
                    class="lg:col-span-3
                            rounded-2xl
                            bg-white
                            border
                            p-12
                            text-center">

                    <div class="text-5xl mb-4">
                        👑
                    </div>

                    <h2 class="text-2xl font-bold">
                        No VIP Plans Available
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Please check again later.
                    </p>

                </div>
            @endforelse

        </div>

    </main>


    {{-- Footer --}}
    <footer class="mt-16 bg-gray-900 text-white">

        <div class="max-w-7xl mx-auto
                    px-4 py-8
                    text-center">

            <p class="text-gray-400">
                © {{ date('Y') }} AutoOne.
                All rights reserved.
            </p>

        </div>

    </footer>

</body>

</html>
