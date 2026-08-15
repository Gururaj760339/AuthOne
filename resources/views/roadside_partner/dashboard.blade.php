<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Roadside Partner Dashboard - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-slate-950 text-white">

        <div class="max-w-7xl mx-auto px-4">

            <div class="h-16 flex items-center justify-between">

                <a href="{{ route('partner.roadside.dashboard') }}"
                   class="flex items-center gap-3">

                    <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center font-bold">
                        A
                    </div>

                    <div>
                        <h1 class="font-bold">
                            AutoOne
                        </h1>

                        <p class="text-xs text-slate-400">
                            Roadside Partner
                        </p>
                    </div>

                </a>


                <div class="hidden md:flex items-center gap-6 text-sm">

                    <a href="{{ route('partner.roadside.dashboard') }}"
                       class="text-red-400 font-semibold">
                        Dashboard
                    </a>

                    <a href="{{ route('partner.roadside.requests') }}"
                       class="text-slate-300 hover:text-white">
                        Requests
                    </a>

                    <a href="{{ route('partner.roadside.active') }}"
                       class="text-slate-300 hover:text-white">
                        Active Services
                    </a>

                    <a href="{{ route('partner.roadside.completed') }}"
                       class="text-slate-300 hover:text-white">
                        Completed
                    </a>

                    <a href="{{ route('partner.roadside.earnings') }}"
                       class="text-slate-300 hover:text-white">
                        Earnings
                    </a>

                </div>


                <div class="flex items-center gap-3">

                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-semibold">
                            {{ auth()->user()->name ?? 'Partner' }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Roadside Partner
                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center font-bold">

                        {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}

                    </div>

                </div>

            </div>

        </div>

    </nav>


    {{-- Header --}}
    <section class="bg-slate-900 text-white">

        <div class="max-w-7xl mx-auto px-4 py-8">

            <p class="text-red-400 text-sm font-semibold">
                ROADSIDE ASSISTANCE PARTNER
            </p>

            <h2 class="text-3xl font-bold mt-2">
                Welcome, {{ auth()->user()->name ?? 'Partner' }}
            </h2>

            <p class="text-slate-400 mt-2">
                Manage your roadside assistance services.
            </p>

        </div>

    </section>


    <main class="max-w-7xl mx-auto px-4 py-8">


        {{-- Messages --}}
        @if(session('success'))

            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl">
                {{ session('error') }}
            </div>

        @endif


        {{-- Availability --}}
        <div class="bg-white rounded-2xl border p-6 mb-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h3 class="font-bold text-lg">
                        Service Availability
                    </h3>

                    <p class="text-sm text-slate-500">
                        Control whether you can receive new requests.
                    </p>

                </div>


                <form action="{{ route('partner.roadside.availability') }}"
                      method="POST">

                    @csrf

                    @if($provider->is_available)

                        <button
                            class="px-5 py-2.5 rounded-xl bg-green-600 text-white font-semibold">

                            ● Available

                        </button>

                    @else

                        <button
                            class="px-5 py-2.5 rounded-xl bg-slate-600 text-white font-semibold">

                            ○ Offline

                        </button>

                    @endif

                </form>

            </div>

        </div>


        {{-- Statistics --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    New Requests
                </p>

                <h3 class="text-3xl font-bold mt-2">
                    {{ $newRequests }}
                </h3>

                <a href="{{ route('partner.roadside.requests') }}"
                   class="text-sm text-red-600 mt-3 inline-block">
                    View Requests →
                </a>

            </div>


            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    Active Services
                </p>

                <h3 class="text-3xl font-bold mt-2">
                    {{ $activeRequests }}
                </h3>

                <a href="{{ route('partner.roadside.active') }}"
                   class="text-sm text-blue-600 mt-3 inline-block">
                    Manage Services →
                </a>

            </div>


            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    Completed Services
                </p>

                <h3 class="text-3xl font-bold mt-2">
                    {{ $completedRequests }}
                </h3>

                <a href="{{ route('partner.roadside.completed') }}"
                   class="text-sm text-green-600 mt-3 inline-block">
                    View History →
                </a>

            </div>


            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    Total Earnings
                </p>

                <h3 class="text-3xl font-bold mt-2">
                    ${{ number_format($totalEarnings, 2) }}
                </h3>

                <a href="{{ route('partner.roadside.earnings') }}"
                   class="text-sm text-purple-600 mt-3 inline-block">
                    View Earnings →
                </a>

            </div>

        </div>


        {{-- Recent Requests --}}
        <div class="bg-white rounded-2xl border mt-8 overflow-hidden">

            <div class="p-6 border-b">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="text-xl font-bold">
                            Recent Requests
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Latest roadside assistance requests.
                        </p>

                    </div>

                    <a href="{{ route('partner.roadside.requests') }}"
                       class="text-red-600 text-sm font-semibold">
                        View All
                    </a>

                </div>

            </div>


            <div class="divide-y">

                @forelse($requests as $request)

                    <div class="p-6">

                        <div class="flex flex-col lg:flex-row lg:items-center gap-5">

                            <div class="flex-1">

                                <h4 class="font-bold">
                                    {{ $request->user->name ?? 'Customer' }}
                                </h4>

                                <p class="text-sm text-slate-500">
                                    {{ ucwords(str_replace('_', ' ', $request->assistance_type)) }}
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $request->address ?? 'Current location' }}
                                </p>

                            </div>


                            <div>

                                @if($request->priority === 'emergency')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                        Emergency
                                    </span>

                                @elseif($request->priority === 'urgent')

                                    <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold">
                                        Urgent
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                        Normal
                                    </span>

                                @endif

                            </div>


                            <a href="{{ route('partner.roadside.request.show', $request->id) }}"
                               class="px-4 py-2 bg-slate-900 text-white rounded-lg text-sm font-semibold">

                                Details

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="p-12 text-center">

                        <div class="text-4xl">
                            🚗
                        </div>

                        <h3 class="font-bold mt-3">
                            No New Requests
                        </h3>

                        <p class="text-sm text-slate-500">
                            New requests will appear here.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Active Services --}}
        <div class="bg-white rounded-2xl border mt-8 overflow-hidden">

            <div class="p-6 border-b">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="text-xl font-bold">
                            Active Services
                        </h3>

                        <p class="text-sm text-slate-500">
                            Your currently active jobs.
                        </p>

                    </div>

                    <a href="{{ route('partner.roadside.active') }}"
                       class="text-blue-600 text-sm font-semibold">
                        View All
                    </a>

                </div>

            </div>


            <div class="divide-y">

                @forelse($activeServices as $service)

                    <div class="p-6">

                        <div class="flex flex-col lg:flex-row lg:items-center gap-5">

                            <div class="flex-1">

                                <h4 class="font-bold">
                                    #RA-{{ $service->id }}
                                </h4>

                                <p class="text-sm text-slate-500">
                                    {{ $service->user->name ?? 'Customer' }}
                                </p>

                                <p class="text-sm text-slate-500">
                                    {{ ucwords(str_replace('_', ' ', $service->assistance_type)) }}
                                </p>

                            </div>


                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">

                                {{ ucwords(str_replace('_', ' ', $service->status)) }}

                            </span>


                            <a href="{{ route('partner.roadside.request.show', $service->id) }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">

                                Manage

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="p-10 text-center text-slate-500">
                        No active services.
                    </div>

                @endforelse

            </div>

        </div>

    </main>


    <footer class="bg-slate-950 text-slate-400 mt-12">

        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm">

            © {{ date('Y') }} AutoOne — Roadside Assistance Partner

        </div>

    </footer>

</div>

</body>
</html>