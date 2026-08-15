<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Active Services - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100">

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

                    <a href="{{ route('partner.roadside.requests') }}">
                        Requests
                    </a>

                    <a href="{{ route('partner.roadside.active') }}" class="text-blue-400">
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
                Active Services
            </h1>

            <p class="text-slate-500">
                Manage your accepted roadside assistance jobs.
            </p>

        </div>


        <div class="space-y-5">

            @forelse($services as $service)
                <div class="bg-white rounded-2xl border p-6">

                    <div class="flex flex-col lg:flex-row gap-6">

                        <div class="flex-1">

                            <div class="flex items-center gap-3">

                                <h2 class="text-xl font-bold">
                                    #RA-{{ $service->id }}
                                </h2>

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">

                                    {{ ucwords(str_replace('_', ' ', $service->status)) }}

                                </span>

                            </div>


                            <div class="grid md:grid-cols-2 gap-5 mt-6">

                                <div>

                                    <p class="text-xs text-slate-400">
                                        CUSTOMER
                                    </p>

                                    <p class="font-semibold mt-1">
                                        {{ $service->user->name ?? 'Customer' }}
                                    </p>

                                    <p class="text-sm text-slate-500">
                                        {{ $service->user->phone ?? '' }}
                                    </p>

                                </div>


                                <div>

                                    <p class="text-xs text-slate-400">
                                        SERVICE
                                    </p>

                                    <p class="font-semibold mt-1">
                                        {{ ucwords(str_replace('_', ' ', $service->assistance_type)) }}
                                    </p>

                                </div>


                                <div class="md:col-span-2">

                                    <p class="text-xs text-slate-400">
                                        LOCATION
                                    </p>

                                    <p class="font-semibold mt-1">
                                        {{ $service->address ?? 'Current location' }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="lg:w-56 flex flex-col gap-3">

                            <a href="{{ route('partner.roadside.request.show', $service->id) }}"
                                class="px-4 py-3 border rounded-xl text-center font-semibold">

                                View Details

                            </a>


                            @if ($service->status === 'accepted')
                                <form action="{{ route('partner.roadside.status', $service->id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="status" value="on_the_way">

                                    <button class="w-full px-4 py-3 bg-blue-600 text-white rounded-xl font-semibold">

                                        🚗 On The Way

                                    </button>

                                </form>
                            @elseif($service->status === 'on_the_way')
                                <form action="{{ route('partner.roadside.status', $service->id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="status" value="arrived">

                                    <button class="w-full px-4 py-3 bg-indigo-600 text-white rounded-xl font-semibold">

                                        📍 Mark Arrived

                                    </button>

                                </form>
                            @elseif($service->status === 'arrived')
                                <form action="{{ route('partner.roadside.status', $service->id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="status" value="in_progress">

                                    <button class="w-full px-4 py-3 bg-purple-600 text-white rounded-xl font-semibold">

                                        🔧 Start Service

                                    </button>

                                </form>
                            @elseif ($service->status === 'in_progress')
                                <form action="{{ route('partner.roadside.status', $service->id) }}"
                                    method="POST" class="mt-4">

                                    @csrf

                                    <input type="hidden" name="status" value="completed">

                                    <label class="block text-sm font-semibold mb-2">
                                        Final Service Amount
                                    </label>

                                    <input type="number" name="amount" step="0.01" min="0" required
                                        placeholder="Enter final amount" class="w-full border rounded-lg px-4 py-3">

                                    <button type="submit"
                                        class="mt-3 bg-green-600
                                            hover:bg-green-700
                                            text-white px-6 py-3
                                            rounded-lg font-semibold">

                                        Complete Service

                                    </button>

                                </form>
                            @elseif($service->status === 'in_progress')
                                <form action="{{ route('partner.roadside.status', $service->id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="status" value="completed">

                                    <button class="w-full px-4 py-3 bg-green-600 text-white rounded-xl font-semibold">

                                        ✓ Complete Service

                                    </button>

                                </form>
                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl border p-16 text-center">

                    <div class="text-5xl">
                        🛠️
                    </div>

                    <h2 class="text-xl font-bold mt-4">
                        No Active Services
                    </h2>

                    <p class="text-slate-500 mt-1">
                        You don't have any active services.
                    </p>

                </div>
            @endforelse

        </div>

    </main>

</body>

</html>
