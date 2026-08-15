<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $partner->name }} - Roadside Partner
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100 min-h-screen">


    <div class="max-w-6xl mx-auto px-4 py-8">


        {{-- Header --}}

        <div
            class="flex flex-col
                md:flex-row
                md:items-center
                md:justify-between
                gap-4 mb-8">


            <div>

                <p class="text-red-600
                      text-sm
                      font-semibold">

                    ROADSIDE PARTNER

                </p>

                <h1 class="text-3xl
                       font-bold
                       text-slate-900">

                    {{ $partner->name }}

                </h1>

                <p class="text-slate-500 mt-1">

                    Partner ID:
                    #{{ $partner->id }}

                </p>

            </div>


            <a href="{{ route('admin.roadside.partners.index') }}"
                class="bg-white
                   border
                   px-5 py-3
                   rounded-xl
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


        {{-- Statistics --}}

        <div
            class="grid grid-cols-1
                sm:grid-cols-2
                lg:grid-cols-5
                gap-4 mb-8">


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm
                      text-slate-500">

                    Total Requests

                </p>

                <p class="text-3xl
                      font-bold
                      mt-2">

                    {{ $totalRequests }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm
                      text-slate-500">

                    Active

                </p>

                <p
                    class="text-3xl
                      font-bold
                      text-blue-600
                      mt-2">

                    {{ $activeRequests }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm
                      text-slate-500">

                    Completed

                </p>

                <p
                    class="text-3xl
                      font-bold
                      text-green-600
                      mt-2">

                    {{ $completedRequests }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm
                      text-slate-500">

                    Cancelled

                </p>

                <p
                    class="text-3xl
                      font-bold
                      text-red-600
                      mt-2">

                    {{ $cancelledRequests }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm
                      text-slate-500">

                    Partner Earnings

                </p>

                <p
                    class="text-2xl
                      font-bold
                      text-purple-600
                      mt-2">

                    {{ number_format($totalEarnings, 2) }}

                </p>

            </div>

        </div>


        <div class="grid grid-cols-1
                lg:grid-cols-3
                gap-6">


            {{-- Partner Information --}}

            <div
                class="lg:col-span-2
                    bg-white
                    border
                    rounded-2xl
                    p-6">


                <h2 class="text-xl
                       font-bold
                       mb-6">

                    Partner Information

                </h2>


                <div class="grid grid-cols-1
                        md:grid-cols-2
                        gap-6">


                    <div>

                        <p class="text-sm
                              text-slate-500">

                            Name

                        </p>

                        <p class="font-semibold mt-1">

                            {{ $partner->name }}

                        </p>

                    </div>


                    <div>

                        <p class="text-sm
                              text-slate-500">

                            User ID

                        </p>

                        <p class="font-semibold mt-1">

                            {{ $partner->user_id }}

                        </p>

                    </div>


                    <div>

                        <p class="text-sm
                              text-slate-500">

                            Phone

                        </p>

                        <p class="font-semibold mt-1">

                            {{ $partner->phone ?? 'N/A' }}

                        </p>

                    </div>


                    <div>

                        <p class="text-sm
                              text-slate-500">

                            Email

                        </p>

                        <p class="font-semibold mt-1">

                            {{ $partner->email ?? ($partner->user->email ?? 'N/A') }}

                        </p>

                    </div>


                    <div>

                        <p class="text-sm
                              text-slate-500">

                            Latitude

                        </p>

                        <p class="font-semibold mt-1">

                            {{ $partner->latitude ?? 'N/A' }}

                        </p>

                    </div>


                    <div>

                        <p class="text-sm
                              text-slate-500">

                            Longitude

                        </p>

                        <p class="font-semibold mt-1">

                            {{ $partner->longitude ?? 'N/A' }}

                        </p>

                    </div>

                </div>


                {{-- Description --}}

                @if (!empty($partner->description))
                    <div class="mt-6">

                        <p class="text-sm
                              text-slate-500">

                            Description

                        </p>

                        <p
                            class="mt-2
                              text-slate-700
                              leading-7">

                            {{ $partner->description }}

                        </p>

                    </div>
                @endif

            </div>


            {{-- Status / Actions --}}

            <div class="space-y-6">


                {{-- Verification --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="font-bold
                           text-lg
                           mb-4">

                        Verification

                    </h2>


                    @if ($partner->is_verified)
                        <div
                            class="bg-green-50
                                text-green-700
                                rounded-xl
                                p-4
                                font-semibold">

                            ✓ Verified Partner

                        </div>
                    @else
                        <div
                            class="bg-yellow-50
                                text-yellow-700
                                rounded-xl
                                p-4
                                font-semibold">

                            ⏳ Verification Pending

                        </div>
                    @endif

                </div>


                {{-- Availability --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="font-bold
                           text-lg
                           mb-4">

                        Availability

                    </h2>


                    @if ($partner->is_available)
                        <div
                            class="bg-blue-50
                                text-blue-700
                                rounded-xl
                                p-4
                                font-semibold">

                            ● Currently Available

                        </div>
                    @else
                        <div
                            class="bg-slate-100
                                text-slate-600
                                rounded-xl
                                p-4
                                font-semibold">

                            ● Offline

                        </div>
                    @endif

                </div>


                {{-- Actions --}}

                <div
                    class="bg-white
                        border
                        rounded-2xl
                        p-6">

                    <h2 class="font-bold
                           text-lg
                           mb-4">

                        Admin Actions

                    </h2>


                    @if (!$partner->is_verified)

                        <form action="{{ route('admin.roadside.partners.approve', $partner->id) }}" method="POST"
                            class="mb-3">

                            @csrf

                            <button type="submit"
                                class="w-full
                                   bg-green-600
                                   hover:bg-green-700
                                   text-white
                                   py-3
                                   rounded-xl
                                   font-semibold">

                                ✓ Approve Partner

                            </button>

                        </form>
                    @else
                        @if ($partner->is_available)
                            <form action="{{ route('admin.roadside.partners.deactivate', $partner->id) }}"
                                method="POST" class="mb-3">

                                @csrf

                                <button type="submit"
                                    class="w-full
                                       bg-orange-500
                                       hover:bg-orange-600
                                       text-white
                                       py-3
                                       rounded-xl
                                       font-semibold">

                                    Disable Partner

                                </button>

                            </form>
                        @else
                            <form action="{{ route('admin.roadside.partners.activate', $partner->id) }}" method="POST"
                                class="mb-3">

                                @csrf

                                <button type="submit"
                                    class="w-full
                                       bg-blue-600
                                       hover:bg-blue-700
                                       text-white
                                       py-3
                                       rounded-xl
                                       font-semibold">

                                    Activate Partner

                                </button>

                            </form>
                        @endif


                        <form action="{{ route('admin.roadside.partners.reject', $partner->id) }}" method="POST"
                            class="mb-3">

                            @csrf

                            <button type="submit"
                                onclick="return confirm(
                                'Reject this partner?'
                            )"
                                class="w-full
                                   border
                                   border-red-600
                                   text-red-600
                                   hover:bg-red-50
                                   py-3
                                   rounded-xl
                                   font-semibold">

                                Reject Partner

                            </button>

                        </form>

                    @endif


                    {{-- Delete --}}

                    <form action="{{ route('admin.roadside.partners.destroy', $partner->id) }}" method="POST">

                        @csrf

                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm(
                            'Are you sure you want to delete this partner?'
                        )"
                            class="w-full
                               border
                               border-red-600
                               text-red-600
                               hover:bg-red-50
                               py-3
                               rounded-xl
                               font-semibold">

                            Delete Partner

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- Financial Summary --}}

        <div class="bg-white
                border
                rounded-2xl
                p-6 mt-6">


            <h2 class="text-xl
                   font-bold
                   mb-5">

                Financial Summary

            </h2>


            <div class="grid grid-cols-1
                    md:grid-cols-3
                    gap-5">


                <div class="bg-slate-50
                        rounded-xl
                        p-5">

                    <p class="text-sm
                          text-slate-500">

                        Total Service Revenue

                    </p>

                    <p class="text-2xl
                          font-bold
                          mt-2">

                        {{ number_format($totalRevenue, 2) }}

                    </p>

                </div>


                <div class="bg-slate-50
                        rounded-xl
                        p-5">

                    <p class="text-sm
                          text-slate-500">

                        AutoOne Platform Fee

                    </p>

                    <p
                        class="text-2xl
                          font-bold
                          text-red-600
                          mt-2">

                        {{ number_format($totalPlatformFee, 2) }}

                    </p>

                </div>


                <div class="bg-slate-50
                        rounded-xl
                        p-5">

                    <p class="text-sm
                          text-slate-500">

                        Partner Earnings

                    </p>

                    <p
                        class="text-2xl
                          font-bold
                          text-green-600
                          mt-2">

                        {{ number_format($totalEarnings, 2) }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
