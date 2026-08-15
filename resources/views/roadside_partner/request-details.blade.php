<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Request Details - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100">

    <nav class="bg-slate-950 text-white">

        <div class="max-w-7xl mx-auto px-4">

            <div class="h-16 flex items-center justify-between">

                <a href="{{ route('partner.roadside.dashboard') }}" class="font-bold text-xl">

                    AutoOne

                </a>

                <a href="{{ route('partner.roadside.requests') }}" class="text-sm text-slate-300">

                    ← Back to Requests

                </a>

            </div>

        </div>

    </nav>


    <main class="max-w-5xl mx-auto px-4 py-8">


        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif


        <div class="bg-white rounded-2xl border overflow-hidden">

            <div class="bg-slate-900 text-white p-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <p class="text-sm text-slate-400">
                            Roadside Assistance Request
                        </p>

                        <h1 class="text-2xl font-bold mt-1">
                            #RA-{{ $request->id }}
                        </h1>

                    </div>


                    <span class="px-4 py-2 rounded-full bg-white/10">

                        {{ ucwords(str_replace('_', ' ', $request->status)) }}

                    </span>

                </div>

            </div>


            <div class="p-6 space-y-8">


                {{-- Customer --}}
                <div>

                    <h2 class="font-bold text-lg">
                        Customer Information
                    </h2>

                    <div class="grid md:grid-cols-2 gap-5 mt-4">

                        <div>

                            <p class="text-xs text-slate-400">
                                NAME
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $request->user->name ?? 'Customer' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-slate-400">
                                PHONE
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $request->user->phone ?? 'Not available' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Service --}}
                <div>

                    <h2 class="font-bold text-lg">
                        Service Information
                    </h2>

                    <div class="grid md:grid-cols-2 gap-5 mt-4">

                        <div>

                            <p class="text-xs text-slate-400">
                                ASSISTANCE TYPE
                            </p>

                            <p class="font-semibold mt-1">
                                {{ ucwords(str_replace('_', ' ', $request->assistance_type)) }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-slate-400">
                                PRIORITY
                            </p>

                            <p class="font-semibold mt-1">
                                {{ ucfirst($request->priority) }}
                            </p>

                        </div>


                        <div class="md:col-span-2">

                            <p class="text-xs text-slate-400">
                                DESCRIPTION
                            </p>

                            <p class="mt-1">
                                {{ $request->description ?? 'No description provided.' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Location --}}
                <div>

                    <h2 class="font-bold text-lg">
                        Customer Location
                    </h2>

                    <div class="bg-slate-50 rounded-xl p-5 mt-4">

                        <p class="font-semibold">
                            {{ $request->address ?? 'Current location' }}
                        </p>


                        @if ($request->latitude && $request->longitude)
                            <p class="text-sm text-slate-500 mt-2">

                                Latitude:
                                {{ $request->latitude }}

                                <br>

                                Longitude:
                                {{ $request->longitude }}

                            </p>


                            <a href="https://www.google.com/maps?q={{ $request->latitude }},{{ $request->longitude }}"
                                target="_blank" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg">

                                📍 Open Google Maps

                            </a>
                        @endif

                    </div>

                </div>


                {{-- Accept --}}
                @if (in_array($request->status, ['pending', 'searching']))
                    <div class="border-t pt-6">

                        <form action="{{ route('partner.roadside.accept', $request->id) }}" method="POST">

                            @csrf

                            <button class="w-full py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold">

                                Accept Roadside Assistance Request

                            </button>

                        </form>

                    </div>
                @endif


                {{-- Status --}}
                @if ($request->provider_id == auth()->id())

                    <div class="border-t pt-6">

                        <h2 class="font-bold mb-4">
                            Update Service
                        </h2>


                        @if ($request->status === 'accepted')
                            <form action="{{ route('partner.roadside.status', $request->id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="on_the_way">

                                <button class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold">

                                    🚗 On The Way

                                </button>

                            </form>
                        @elseif($request->status === 'on_the_way')
                            <form action="{{ route('partner.roadside.status', $request->id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="arrived">

                                <button class="w-full py-3 bg-indigo-600 text-white rounded-xl font-bold">

                                    📍 Mark Arrived

                                </button>

                            </form>
                        @elseif($request->status === 'arrived')
                            <form action="{{ route('partner.roadside.status', $request->id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="in_progress">

                                <button class="w-full py-3 bg-purple-600 text-white rounded-xl font-bold">

                                    🔧 Start Service

                                </button>

                            </form>
                        @elseif($request->status === 'in_progress')
                            <form action="{{ route('partner.roadside.status', $request->id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="completed">

                                <button class="w-full py-3 bg-green-600 text-white rounded-xl font-bold">

                                    ✓ Complete Service

                                </button>

                            </form>
                        @endif

                    </div>

                @endif

            </div>

        </div>

    </main>

</body>

</html>
