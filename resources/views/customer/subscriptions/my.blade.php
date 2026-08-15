<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Memberships | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-50 text-gray-900">


    {{-- Navbar --}}
    <nav class="bg-white border-b">

        <div class="max-w-7xl mx-auto
                    px-4 py-4
                    flex items-center
                    justify-between">

            <a href="{{ url('/') }}"
               class="text-2xl font-bold">

                AutoOne

            </a>


            <div class="flex items-center gap-5">

                <a href="{{ route('subscriptions.index') }}"
                   class="text-gray-600 hover:text-black">

                    VIP Membership

                </a>


                <a href="{{ route('subscriptions.my') }}"
                   class="font-semibold text-gray-900">

                    My Memberships

                </a>

            </div>

        </div>

    </nav>


    <main class="max-w-6xl mx-auto
                 px-4 py-12">


        {{-- Header --}}
        <div class="mb-10">

            <div class="flex items-center gap-3">

                <div class="flex items-center
                            justify-center
                            w-12 h-12
                            rounded-xl
                            bg-yellow-100">

                    <span class="text-2xl">
                        👑
                    </span>

                </div>


                <div>

                    <h1 class="text-3xl font-bold">
                        My Memberships
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Manage your AutoOne VIP memberships.
                    </p>

                </div>

            </div>

        </div>


        {{-- Success --}}
        @if(session('success'))

            <div class="mb-6 rounded-xl
                        border border-green-200
                        bg-green-50
                        px-5 py-4
                        text-green-700">

                {{ session('success') }}

            </div>

        @endif


        {{-- Error --}}
        @if(session('error'))

            <div class="mb-6 rounded-xl
                        border border-red-200
                        bg-red-50
                        px-5 py-4
                        text-red-700">

                {{ session('error') }}

            </div>

        @endif


        {{-- Membership List --}}
        <div class="space-y-5">

            @forelse($subscriptions as $subscription)

                <div class="bg-white
                            rounded-2xl
                            border border-gray-200
                            shadow-sm
                            overflow-hidden">


                    <div class="p-6">

                        <div class="flex flex-col
                                    lg:flex-row
                                    lg:items-center
                                    lg:justify-between
                                    gap-6">


                            {{-- Plan --}}
                            <div class="min-w-[220px]">

                                <div class="flex items-center gap-3">

                                    <h2 class="text-xl font-bold">

                                        {{ $subscription->plan->name }}

                                    </h2>


                                    @if($subscription->status === 'active')

                                        <span class="rounded-full
                                                     bg-green-100
                                                     px-3 py-1
                                                     text-xs
                                                     font-bold
                                                     text-green-700">

                                            ACTIVE

                                        </span>

                                    @elseif($subscription->status === 'expired')

                                        <span class="rounded-full
                                                     bg-gray-100
                                                     px-3 py-1
                                                     text-xs
                                                     font-bold
                                                     text-gray-600">

                                            EXPIRED

                                        </span>

                                    @elseif($subscription->status === 'cancelled')

                                        <span class="rounded-full
                                                     bg-red-100
                                                     px-3 py-1
                                                     text-xs
                                                     font-bold
                                                     text-red-700">

                                            CANCELLED

                                        </span>

                                    @else

                                        <span class="rounded-full
                                                     bg-yellow-100
                                                     px-3 py-1
                                                     text-xs
                                                     font-bold
                                                     text-yellow-700">

                                            {{ strtoupper(
                                                $subscription->status
                                            ) }}

                                        </span>

                                    @endif

                                </div>


                                <p class="mt-2 text-gray-500">

                                    {{ $subscription->plan->description }}

                                </p>

                            </div>


                            {{-- Price --}}
                            <div>

                                <p class="text-sm text-gray-500">
                                    Price
                                </p>

                                <p class="text-lg font-bold">

                                    {{ number_format(
                                        $subscription->plan->price,
                                        2
                                    ) }}

                                    {{ $subscription->plan->currency }}

                                </p>

                            </div>


                            {{-- Discount --}}
                            <div>

                                <p class="text-sm text-gray-500">
                                    Discount
                                </p>

                                <p class="text-lg font-bold text-green-600">

                                    {{ $subscription->plan->discount_percentage }}%

                                </p>

                            </div>


                            {{-- Start --}}
                            <div>

                                <p class="text-sm text-gray-500">
                                    Started
                                </p>

                                <p class="font-semibold">

                                    {{ $subscription->starts_at
                                        ? $subscription->starts_at->format('d M Y')
                                        : '-' }}

                                </p>

                            </div>


                            {{-- End --}}
                            <div>

                                <p class="text-sm text-gray-500">
                                    Expires
                                </p>

                                <p class="font-semibold">

                                    {{ $subscription->ends_at
                                        ? $subscription->ends_at->format('d M Y')
                                        : '-' }}

                                </p>

                            </div>


                            {{-- Cancel --}}
                            @if($subscription->status === 'active')

                                <div>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'subscriptions.cancel',
                                            $subscription->id
                                        ) }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            onclick="return confirm(
                                                'Are you sure you want to cancel this membership?'
                                            )"
                                            class="rounded-xl
                                                   bg-red-600
                                                   px-5 py-2.5
                                                   text-sm
                                                   font-semibold
                                                   text-white
                                                   hover:bg-red-700
                                                   transition">

                                            Cancel

                                        </button>

                                    </form>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- Active Benefits --}}
                    @if($subscription->status === 'active')

                        <div class="border-t
                                    bg-gray-50
                                    px-6 py-5">

                            <p class="mb-3
                                      text-sm
                                      font-semibold
                                      text-gray-700">

                                Your Benefits

                            </p>


                            <div class="flex flex-wrap gap-3">

                                <span class="rounded-full
                                             bg-green-100
                                             px-4 py-2
                                             text-sm
                                             text-green-700">

                                    ✓
                                    {{ $subscription->plan->discount_percentage }}%
                                    General Discount

                                </span>


                                <span class="rounded-full
                                             bg-green-100
                                             px-4 py-2
                                             text-sm
                                             text-green-700">

                                    ✓
                                    {{ $subscription->plan->car_wash_discount }}%
                                    Car Wash

                                </span>


                                <span class="rounded-full
                                             bg-green-100
                                             px-4 py-2
                                             text-sm
                                             text-green-700">

                                    ✓
                                    {{ $subscription->plan->rental_discount }}%
                                    Rental

                                </span>


                                <span class="rounded-full
                                             bg-green-100
                                             px-4 py-2
                                             text-sm
                                             text-green-700">

                                    ✓
                                    {{ $subscription->plan->roadside_discount }}%
                                    Roadside

                                </span>


                                @if($subscription->plan->priority_booking)

                                    <span class="rounded-full
                                                 bg-blue-100
                                                 px-4 py-2
                                                 text-sm
                                                 text-blue-700">

                                        ✓ Priority Booking

                                    </span>

                                @endif


                                @if($subscription->plan->free_inspection)

                                    <span class="rounded-full
                                                 bg-purple-100
                                                 px-4 py-2
                                                 text-sm
                                                 text-purple-700">

                                        ✓ Free Inspection

                                    </span>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>

            @empty


                {{-- Empty State --}}
                <div class="bg-white
                            rounded-2xl
                            border
                            p-12
                            text-center">


                    <div class="flex items-center
                                justify-center
                                w-20 h-20
                                mx-auto
                                rounded-full
                                bg-yellow-100">

                        <span class="text-4xl">
                            👑
                        </span>

                    </div>


                    <h2 class="mt-6
                               text-2xl
                               font-bold">

                        No Membership Found

                    </h2>


                    <p class="mt-2
                              max-w-md
                              mx-auto
                              text-gray-500">

                        You don't have any VIP membership yet.
                        Choose a plan and start saving on AutoOne services.

                    </p>


                    <a
                        href="{{ route('subscriptions.index') }}"
                        class="inline-block
                               mt-6
                               rounded-xl
                               bg-gray-900
                               px-6 py-3
                               font-semibold
                               text-white
                               hover:bg-gray-700">

                        Explore VIP Plans

                    </a>

                </div>

            @endforelse

        </div>

    </main>


    {{-- Footer --}}
    <footer class="mt-16 bg-gray-900">

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