<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assistance Requests - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <div class="min-h-screen">

        <nav class="bg-slate-950 text-white">

            <div class="max-w-7xl mx-auto px-4">

                <div class="h-16 flex items-center justify-between">

                    <a href="{{ route('partner.roadside.dashboard') }}" class="font-bold text-xl">

                        AutoOne

                    </a>

                    <div class="flex gap-6 text-sm">

                        <a href="{{ route('partner.roadside.dashboard') }}">
                            Dashboard
                        </a>

                        <a href="{{ route('partner.roadside.requests') }}" class="text-red-400">
                            Requests
                        </a>

                        <a href="{{ route('partner.roadside.active') }}">
                            Active
                        </a>

                        <a href="{{ route('partner.roadside.completed') }}">
                            Completed
                        </a>

                        <a href="{{ route('partner.roadside.earnings') }}">
                            Earnings
                        </a>

                    </div>

                </div>

            </div>

        </nav>


        <main class="max-w-7xl mx-auto px-4 py-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold">
                    Assistance Requests
                </h1>

                <p class="text-slate-500 mt-1">
                    New roadside assistance requests available for you.
                </p>

            </div>


            <div class="space-y-5">

                @forelse($requests as $request)
                    <div class="bg-white rounded-2xl border p-6">

                        <div class="flex flex-col lg:flex-row gap-6">

                            <div class="flex-1">

                                <div class="flex items-center gap-3">

                                    <h2 class="text-xl font-bold">
                                        #RA-{{ $request->id }}
                                    </h2>

                                    @if ($request->priority === 'emergency')
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                            Emergency
                                        </span>
                                    @elseif($request->priority === 'urgent')
                                        <span
                                            class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold">
                                            Urgent
                                        </span>
                                    @endif

                                </div>


                                <div class="grid md:grid-cols-2 gap-5 mt-5">

                                    <div>

                                        <p class="text-xs text-slate-400">
                                            CUSTOMER
                                        </p>

                                        <p class="font-semibold mt-1">
                                            {{ $request->user->name ?? 'Customer' }}
                                        </p>

                                        <p class="text-sm text-slate-500">
                                            {{ $request->user->phone ?? '' }}
                                        </p>

                                    </div>


                                    <div>

                                        <p class="text-xs text-slate-400">
                                            ASSISTANCE TYPE
                                        </p>

                                        <p class="font-semibold mt-1">
                                            {{ ucwords(str_replace('_', ' ', $request->assistance_type)) }}
                                        </p>

                                    </div>


                                    <div class="md:col-span-2">

                                        <p class="text-xs text-slate-400">
                                            LOCATION
                                        </p>

                                        <p class="font-semibold mt-1">
                                            {{ $request->address ?? 'Current location' }}
                                        </p>

                                        @if ($request->latitude && $request->longitude)
                                            <a href="https://www.google.com/maps?q={{ $request->latitude }},{{ $request->longitude }}"
                                                target="_blank" class="text-blue-600 text-sm">

                                                📍 Open Location

                                            </a>
                                        @endif

                                    </div>


                                    <div class="md:col-span-2">

                                        <p class="text-xs text-slate-400">
                                            DESCRIPTION
                                        </p>

                                        <p class="mt-1 text-slate-700">
                                            {{ $request->description ?? 'No description provided.' }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="lg:w-48 flex lg:flex-col justify-end gap-3">

                                <a href="{{ route('partner.roadside.request.show', $request->id) }}"
                                    class="px-4 py-3 rounded-xl border text-center font-semibold">

                                    View Details

                                </a>


                                <form action="{{ route('partner.roadside.accept', $request->id) }}" method="POST">

                                    @csrf

                                    <button
                                        class="w-full px-4 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold">

                                        Accept Request

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="bg-white rounded-2xl border p-16 text-center">

                        <div class="text-5xl">
                            🚗
                        </div>

                        <h2 class="text-xl font-bold mt-4">
                            No Requests Available
                        </h2>

                        <p class="text-slate-500 mt-1">
                            There are currently no new roadside assistance requests.
                        </p>

                    </div>
                @endforelse

            </div>

        </main>

    </div>

</body>

</html>
