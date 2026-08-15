<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Roadside Partners - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">


        {{-- Header --}}

        <div class="mb-8">

            <p class="text-red-600
                  text-sm
                  font-semibold">

                AUTOONE ADMIN

            </p>

            <h1 class="text-3xl
                   font-bold
                   text-slate-900
                   mt-1">

                Roadside Partners

            </h1>

            <p class="text-slate-500 mt-2">

                Manage roadside assistance partners.

            </p>

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

                <p class="text-sm text-slate-500">
                    Total Partners
                </p>

                <p class="text-3xl
                      font-bold
                      mt-2">

                    {{ $totalPartners }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Verified
                </p>

                <p class="text-3xl
                      font-bold
                      text-green-600 mt-2">

                    {{ $verifiedPartners }}

                </p>

            </div>


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

                    {{ $pendingPartners }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Available
                </p>

                <p class="text-3xl
                      font-bold
                      text-blue-600 mt-2">

                    {{ $availablePartners }}

                </p>

            </div>


            <div class="bg-white
                    border
                    rounded-2xl
                    p-5">

                <p class="text-sm text-slate-500">
                    Offline
                </p>

                <p class="text-3xl
                      font-bold
                      text-slate-600 mt-2">

                    {{ $offlinePartners }}

                </p>

            </div>

        </div>


        {{-- Filters --}}

        <div class="bg-white
                border
                rounded-2xl
                p-5 mb-6">

            <form method="GET" action="{{ route('admin.roadside.partners.index') }}"
                class="grid grid-cols-1
                   md:grid-cols-4
                   gap-4">


                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search partner..."
                    class="border
                       rounded-xl
                       px-4 py-3
                       outline-none
                       focus:ring-2
                       focus:ring-red-500">


                <select name="verification"
                    class="border
                       rounded-xl
                       px-4 py-3">

                    <option value="">
                        All Verification
                    </option>

                    <option value="verified"
                        {{ request('verification') === 'verified' ? 'selected' : '' }}>

                        Verified

                    </option>

                    <option value="pending"
                        {{ request('verification') === 'pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                </select>


                <select name="availability"
                    class="border
                       rounded-xl
                       px-4 py-3">

                    <option value="">
                        All Availability
                    </option>

                    <option value="available"
                        {{ request('availability') === 'available' ? 'selected' : '' }}>

                        Available

                    </option>

                    <option value="offline"
                        {{ request('availability') === 'offline' ? 'selected' : '' }}>

                        Offline

                    </option>

                </select>


                <button type="submit"
                    class="bg-slate-900
                       text-white
                       rounded-xl
                       font-semibold">

                    Filter

                </button>

            </form>

        </div>


        {{-- Partners Table --}}

        <div class="bg-white
                border
                rounded-2xl
                overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50
                              border-b">

                        <tr>

                            <th
                                class="text-left
                                   px-5 py-4
                                   text-sm">

                                ID

                            </th>

                            <th
                                class="text-left
                                   px-5 py-4
                                   text-sm">

                                Partner

                            </th>

                            <th
                                class="text-left
                                   px-5 py-4
                                   text-sm">

                                Contact

                            </th>

                            <th
                                class="text-left
                                   px-5 py-4
                                   text-sm">

                                Verification

                            </th>

                            <th
                                class="text-left
                                   px-5 py-4
                                   text-sm">

                                Availability

                            </th>

                            <th
                                class="text-left
                                   px-5 py-4
                                   text-sm">

                                Action

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($partners as $partner)

                            <tr class="hover:bg-slate-50">


                                {{-- ID --}}

                                <td class="px-5 py-4">

                                    #{{ $partner->id }}

                                </td>


                                {{-- Partner --}}

                                <td class="px-5 py-4">

                                    <p class="font-semibold">

                                        {{ $partner->name }}

                                    </p>

                                    <p class="text-xs
                                          text-slate-500">

                                        User ID:
                                        {{ $partner->user_id }}

                                    </p>

                                </td>


                                {{-- Contact --}}

                                <td class="px-5 py-4">

                                    <p>

                                        {{ $partner->phone ?? 'N/A' }}

                                    </p>

                                    <p class="text-xs
                                          text-slate-500">

                                        {{ $partner->email ?? ($partner->user->email ?? 'N/A') }}

                                    </p>

                                </td>


                                {{-- Verification --}}

                                <td class="px-5 py-4">

                                    @if ($partner->is_verified)
                                        <span
                                            class="px-3 py-1
                                                 rounded-full
                                                 text-xs
                                                 font-semibold
                                                 bg-green-100
                                                 text-green-700">

                                            Verified

                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1
                                                 rounded-full
                                                 text-xs
                                                 font-semibold
                                                 bg-yellow-100
                                                 text-yellow-700">

                                            Pending

                                        </span>
                                    @endif

                                </td>


                                {{-- Availability --}}

                                <td class="px-5 py-4">

                                    @if ($partner->is_available)
                                        <span
                                            class="px-3 py-1
                                                 rounded-full
                                                 text-xs
                                                 font-semibold
                                                 bg-blue-100
                                                 text-blue-700">

                                            Available

                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1
                                                 rounded-full
                                                 text-xs
                                                 font-semibold
                                                 bg-slate-100
                                                 text-slate-600">

                                            Offline

                                        </span>
                                    @endif

                                </td>


                                {{-- Action --}}

                                <td class="px-5 py-4">

                                    <div
                                        class="flex
                                            flex-wrap
                                            gap-2">


                                        {{-- View --}}

                                        <a href="{{ route('admin.roadside.partners.show', $partner->id) }}"
                                            class="bg-slate-900
                                               text-white
                                               px-3 py-2
                                               rounded-lg
                                               text-sm">

                                            View

                                        </a>


                                        {{-- Approve --}}

                                        @if (!$partner->is_verified)
                                            <form
                                                action="{{ route('admin.roadside.partners.approve', $partner->id) }}"
                                                method="POST">

                                                @csrf

                                                <button type="submit"
                                                    class="bg-green-600
                                                       text-white
                                                       px-3 py-2
                                                       rounded-lg
                                                       text-sm">

                                                    Approve

                                                </button>

                                            </form>
                                        @else
                                            {{-- Deactivate --}}

                                            @if ($partner->is_available)
                                                <form
                                                    action="{{ route('admin.roadside.partners.deactivate', $partner->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    <button type="submit"
                                                        class="bg-orange-500
                                                           text-white
                                                           px-3 py-2
                                                           rounded-lg
                                                           text-sm">

                                                        Disable

                                                    </button>

                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('admin.roadside.partners.activate', $partner->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    <button type="submit"
                                                        class="bg-blue-600
                                                           text-white
                                                           px-3 py-2
                                                           rounded-lg
                                                           text-sm">

                                                        Activate

                                                    </button>

                                                </form>
                                            @endif
                                        @endif


                                        {{-- Reject --}}

                                        @if ($partner->is_verified)
                                            <form
                                                action="{{ route('admin.roadside.partners.reject', $partner->id) }}"
                                                method="POST">

                                                @csrf

                                                <button type="submit"
                                                    onclick="return confirm(
                                                    'Reject this partner?'
                                                )"
                                                    class="border
                                                       border-red-600
                                                       text-red-600
                                                       px-3 py-2
                                                       rounded-lg
                                                       text-sm">

                                                    Reject

                                                </button>

                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center
                                       py-12
                                       text-slate-500">

                                    No roadside partners found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="p-5 border-t">

                {{ $partners->links() }}

            </div>

        </div>

    </div>

</body>

</html>
