<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Roadside Request #{{ $roadsideRequest->id }}
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100 min-h-screen">


    <div class="max-w-5xl mx-auto px-4 py-8">


        {{-- Header --}}

        <div class="flex items-center
                justify-between mb-8">

            <div>

                <p class="text-sm
                      text-red-600
                      font-semibold">

                    ROADSIDE ASSISTANCE

                </p>

                <h1 class="text-3xl
                       font-bold
                       text-slate-900">

                    Request #{{ $roadsideRequest->id }}

                </h1>

            </div>


            <a href="{{ route('admin.roadside.requests.index') }}"
                class="border
                  bg-white
                  px-5 py-3
                  rounded-xl
                  text-sm
                  font-semibold">

                ← Back

            </a>

        </div>


        {{-- Messages --}}

        @if (session('success'))
            <div
                class="mb-6
                    bg-green-50
                    border border-green-200
                    text-green-700
                    rounded-xl
                    p-4">

                {{ session('success') }}

            </div>
        @endif


        @if (session('error'))
            <div
                class="mb-6
                    bg-red-50
                    border border-red-200
                    text-red-700
                    rounded-xl
                    p-4">

                {{ session('error') }}

            </div>
        @endif


        <div class="grid grid-cols-1
                lg:grid-cols-3
                gap-6">


            {{-- Main Information --}}

            <div class="lg:col-span-2
                    space-y-6">


                {{-- Request Information --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="text-xl
                           font-bold
                           mb-5">

                        Request Information

                    </h2>


                    <div
                        class="grid grid-cols-1
                            md:grid-cols-2
                            gap-5">


                        <div>

                            <p class="text-sm
                                  text-slate-500">

                                Service

                            </p>

                            <p class="font-semibold mt-1">

                                {{ $roadsideRequest->service }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm
                                  text-slate-500">

                                Vehicle

                            </p>

                            <p class="font-semibold mt-1">

                                {{ $roadsideRequest->vehicle_number }}

                            </p>

                            <p class="text-sm
                                  text-slate-500">

                                {{ $roadsideRequest->vehicle_model }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm
                                  text-slate-500">

                                Phone

                            </p>

                            <p class="font-semibold mt-1">

                                {{ $roadsideRequest->phone }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm
                                  text-slate-500">

                                Amount

                            </p>

                            <p
                                class="text-xl
                                  font-bold
                                  text-green-600 mt-1">

                                @if ($roadsideRequest->amount !== null)
                                    {{ number_format($roadsideRequest->amount, 2) }}
                                @else
                                    Not Set
                                @endif

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Location --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="text-xl
                           font-bold
                           mb-5">

                        Customer Location

                    </h2>


                    <p class="text-slate-700">

                        {{ $roadsideRequest->location }}

                    </p>


                    <div class="grid grid-cols-2
                            gap-4 mt-5">

                        <div
                            class="bg-slate-50
                                rounded-xl
                                p-4">

                            <p class="text-xs
                                  text-slate-500">

                                Latitude

                            </p>

                            <p class="font-semibold">

                                {{ $roadsideRequest->latitude }}

                            </p>

                        </div>


                        <div
                            class="bg-slate-50
                                rounded-xl
                                p-4">

                            <p class="text-xs
                                  text-slate-500">

                                Longitude

                            </p>

                            <p class="font-semibold">

                                {{ $roadsideRequest->longitude }}

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Problem --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="text-xl
                           font-bold
                           mb-4">

                        Problem Description

                    </h2>

                    <p class="text-slate-600
                          leading-7">

                        {{ $roadsideRequest->description ?? 'No description provided.' }}

                    </p>

                </div>


                {{-- Timeline --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="text-xl
                           font-bold
                           mb-5">

                        Service Timeline

                    </h2>


                    <div class="space-y-4">


                        @if ($roadsideRequest->on_the_way_at)
                            <div>

                                <p class="font-semibold">
                                    🚗 Provider On The Way
                                </p>

                                <p class="text-sm
                                      text-slate-500">

                                    {{ $roadsideRequest->on_the_way_at->format('d M Y, h:i A') }}

                                </p>

                            </div>
                        @endif


                        @if ($roadsideRequest->arrived_at)
                            <div>

                                <p class="font-semibold">
                                    📍 Provider Arrived
                                </p>

                                <p class="text-sm
                                      text-slate-500">

                                    {{ $roadsideRequest->arrived_at->format('d M Y, h:i A') }}

                                </p>

                            </div>
                        @endif


                        @if ($roadsideRequest->started_at)
                            <div>

                                <p class="font-semibold">
                                    🔧 Service Started
                                </p>

                                <p class="text-sm
                                      text-slate-500">

                                    {{ $roadsideRequest->started_at->format('d M Y, h:i A') }}

                                </p>

                            </div>
                        @endif


                        @if ($roadsideRequest->completed_at)
                            <div>

                                <p class="font-semibold text-green-600">
                                    ✅ Service Completed
                                </p>

                                <p class="text-sm
                                      text-slate-500">

                                    {{ $roadsideRequest->completed_at->format('d M Y, h:i A') }}

                                </p>

                            </div>
                        @endif


                    </div>

                </div>

            </div>


            {{-- Sidebar --}}

            <div class="space-y-6">


                {{-- Status --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <p class="text-sm
                          text-slate-500">

                        Current Status

                    </p>

                    <p class="text-2xl
                          font-bold
                          mt-2">

                        {{ ucwords(str_replace('_', ' ', $roadsideRequest->status)) }}

                    </p>

                </div>


                {{-- Customer --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="font-bold
                           text-lg
                           mb-4">

                        Customer

                    </h2>

                    <p class="font-semibold">

                        {{ $roadsideRequest->user->name ?? 'N/A' }}

                    </p>

                    <p class="text-sm
                          text-slate-500 mt-1">

                        {{ $roadsideRequest->user->email ?? 'N/A' }}

                    </p>

                </div>


                {{-- Provider --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="font-bold
                           text-lg
                           mb-4">

                        Roadside Provider

                    </h2>


                    @if ($roadsideRequest->provider)
                        <p class="font-semibold">

                            {{ $roadsideRequest->provider->name }}

                        </p>

                        <p class="text-sm
                              text-slate-500 mt-1">

                            Provider ID:
                            {{ $roadsideRequest->provider->id }}

                        </p>
                    @else
                        <p class="text-slate-400">
                            No provider assigned.
                        </p>
                    @endif

                </div>


                {{-- Admin Actions --}}

                @if (!in_array($roadsideRequest->status, ['completed', 'cancelled']))
                    <div
                        class="bg-white
                            border
                            rounded-2xl
                            p-6">

                        <h2
                            class="font-bold
                               text-lg
                               mb-4">

                            Admin Actions

                        </h2>


                        <form
                            action="{{ route('admin.roadside.requests.cancel', $roadsideRequest->id) }}"
                            method="POST">

                            @csrf

                            <button type="submit"
                                onclick="return confirm(
                                'Cancel this roadside request?'
                            )"
                                class="w-full
                                   bg-red-600
                                   hover:bg-red-700
                                   text-white
                                   py-3
                                   rounded-xl
                                   font-semibold">

                                Cancel Request

                            </button>

                        </form>

                    </div>
                @endif


                {{-- Delete --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <form
                        action="{{ route('admin.roadside.requests.destroy', $roadsideRequest->id) }}"
                        method="POST">

                        @csrf

                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm(
                            'Are you sure you want to delete this request?'
                        )"
                            class="w-full
                               border border-red-600
                               text-red-600
                               hover:bg-red-50
                               py-3
                               rounded-xl
                               font-semibold">

                            Delete Request

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
