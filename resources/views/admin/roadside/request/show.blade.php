<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Roadside Requests - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100 min-h-screen">


    <div class="max-w-7xl mx-auto px-4 py-8">


        {{-- Header --}}

        <div
            class="flex flex-col md:flex-row
                md:items-center
                md:justify-between
                gap-4 mb-8">

            <div>

                <p class="text-red-600
                      text-sm
                      font-semibold">

                    AUTOONE ADMIN

                </p>

                <h1 class="text-3xl
                       font-bold
                       text-slate-900">

                    Roadside Assistance Requests

                </h1>

                <p class="text-slate-500 mt-1">

                    Manage and monitor roadside assistance requests.

                </p>

            </div>

        </div>


        {{-- Success --}}

        @if (session('success'))
            <div
                class="mb-6
                    bg-green-50
                    border border-green-200
                    text-green-700
                    rounded-xl
                    px-5 py-4">

                {{ session('success') }}

            </div>
        @endif


        {{-- Error --}}

        @if (session('error'))
            <div
                class="mb-6
                    bg-red-50
                    border border-red-200
                    text-red-700
                    rounded-xl
                    px-5 py-4">

                {{ session('error') }}

            </div>
        @endif


        {{-- Statistics --}}

        <div
            class="grid grid-cols-1
                sm:grid-cols-2
                lg:grid-cols-5
                gap-4 mb-8">


            {{-- Total --}}

            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Total Requests
                </p>

                <p class="text-3xl
                      font-bold
                      text-slate-900 mt-2">

                    {{ $totalRequests }}

                </p>

            </div>


            {{-- Pending --}}

            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Pending
                </p>

                <p class="text-3xl
                      font-bold
                      text-yellow-600 mt-2">

                    {{ $pendingRequests }}

                </p>

            </div>


            {{-- Accepted --}}

            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Accepted
                </p>

                <p class="text-3xl
                      font-bold
                      text-blue-600 mt-2">

                    {{ $acceptedRequests }}

                </p>

            </div>


            {{-- Active --}}

            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Active
                </p>

                <p class="text-3xl
                      font-bold
                      text-purple-600 mt-2">

                    {{ $activeRequests }}

                </p>

            </div>


            {{-- Completed --}}

            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Completed
                </p>

                <p class="text-3xl
                      font-bold
                      text-green-600 mt-2">

                    {{ $completedRequests }}

                </p>

            </div>

        </div>


        {{-- Filters --}}

        <div class="bg-white
                border
                rounded-2xl
                p-5 mb-6">

            <form method="GET" action="{{ route('admin.roadside.requests.index') }}"
                class="grid grid-cols-1
                     md:grid-cols-3
                     gap-4">


                {{-- Search --}}

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search ID, vehicle, service..."
                    class="border
                       rounded-xl
                       px-4 py-3
                       outline-none
                       focus:ring-2
                       focus:ring-red-500">


                {{-- Status --}}

                <select name="status"
                    class="border
                       rounded-xl
                       px-4 py-3
                       outline-none
                       focus:ring-2
                       focus:ring-red-500">

                    <option value="">
                        All Status
                    </option>

                    <option value="pending"
                        {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="accepted"
                        {{ request('status') == 'accepted' ? 'selected' : '' }}>
                        Accepted
                    </option>

                    <option value="on_the_way"
                        {{ request('status') == 'on_the_way' ? 'selected' : '' }}>
                        On The Way
                    </option>

                    <option value="arrived"
                        {{ request('status') == 'arrived' ? 'selected' : '' }}>
                        Arrived
                    </option>

                    <option value="in_progress"
                        {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="completed"
                        {{ request('status') == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="cancelled"
                        {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>


                {{-- Button --}}

                <button type="submit"
                    class="bg-slate-900
                       hover:bg-slate-800
                       text-white
                       rounded-xl
                       px-5 py-3
                       font-semibold">

                    Search / Filter

                </button>

            </form>

        </div>


        {{-- Requests Table --}}

        <div class="bg-white
                border
                rounded-2xl
                overflow-hidden">


            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-slate-50
                              border-b">

                        <tr>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                ID

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Customer

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Provider

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Service

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Vehicle

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Amount

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Status

                            </th>

                            <th
                                class="px-5 py-4
                                   text-sm
                                   font-semibold">

                                Action

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($requests as $roadsideRequest)
                            <tr class="hover:bg-slate-50">


                                {{-- ID --}}

                                <td class="px-5 py-4">

                                    #{{ $roadsideRequest->id }}

                                </td>


                                {{-- Customer --}}

                                <td class="px-5 py-4">

                                    <p class="font-semibold">

                                        {{ $roadsideRequest->user->name ?? 'N/A' }}

                                    </p>

                                    <p class="text-xs
                                          text-slate-500">

                                        {{ $roadsideRequest->phone }}

                                    </p>

                                </td>


                                {{-- Provider --}}

                                <td class="px-5 py-4">

                                    @if ($roadsideRequest->provider)
                                        <p class="font-semibold">

                                            {{ $roadsideRequest->provider->name }}

                                        </p>

                                        <p class="text-xs
                                              text-slate-500">

                                            ID:
                                            {{ $roadsideRequest->provider->id }}

                                        </p>
                                    @else
                                        <span class="text-slate-400">
                                            Not Assigned
                                        </span>
                                    @endif

                                </td>


                                {{-- Service --}}

                                <td class="px-5 py-4">

                                    {{ $roadsideRequest->service }}

                                </td>


                                {{-- Vehicle --}}

                                <td class="px-5 py-4">

                                    <p class="font-medium">

                                        {{ $roadsideRequest->vehicle_number }}

                                    </p>

                                    <p class="text-xs
                                          text-slate-500">

                                        {{ $roadsideRequest->vehicle_model }}

                                    </p>

                                </td>


                                {{-- Amount --}}

                                <td class="px-5 py-4">

                                    @if ($roadsideRequest->amount !== null)
                                        <span class="font-semibold">

                                            {{ number_format($roadsideRequest->amount, 2) }}

                                        </span>
                                    @else
                                        <span class="text-slate-400">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}

                                <td class="px-5 py-4">

                                    @php

                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',

                                            'accepted' => 'bg-blue-100 text-blue-700',

                                            'on_the_way' => 'bg-indigo-100 text-indigo-700',

                                            'arrived' => 'bg-purple-100 text-purple-700',

                                            'in_progress' => 'bg-orange-100 text-orange-700',

                                            'completed' => 'bg-green-100 text-green-700',

                                            'cancelled' => 'bg-red-100 text-red-700',
                                        ];

                                    @endphp


                                    <span
                                        class="px-3 py-1
                                             rounded-full
                                             text-xs
                                             font-semibold
                                             {{ $statusClasses[$roadsideRequest->status] ?? 'bg-slate-100 text-slate-600' }}">

                                        {{ ucwords(str_replace('_', ' ', $roadsideRequest->status)) }}

                                    </span>

                                </td>


                                {{-- Action --}}

                                <td class="px-5 py-4">

                                    <a href="{{ route('admin.roadside.requests.show', $roadsideRequest->id) }}"
                                        class="inline-block
                                           bg-slate-900
                                           hover:bg-slate-800
                                           text-white
                                           px-4 py-2
                                           rounded-lg
                                           text-sm">

                                        View

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="px-5 py-12
                                       text-center
                                       text-slate-500">

                                    No roadside requests found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}

            <div class="p-5 border-t">

                {{ $requests->links() }}

            </div>

        </div>

    </div>

</body>

</html>
