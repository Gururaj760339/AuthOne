<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Finance Partner Dashboard
    </title>


    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 min-h-screen">


    <div class="container mx-auto px-4 py-6">


        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">



            {{-- Sidebar --}}

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center text-white">

                    <div
                        class="w-20 h-20 rounded-full bg-white/20 mx-auto flex items-center justify-center text-3xl font-bold">

                        {{ substr($partner->bank_name, 0, 1) }}

                    </div>

                    <h2 class="mt-4 text-xl font-bold">
                        {{ $partner->bank_name }}
                    </h2>

                    <p class="text-blue-100">
                        Finance Partner
                    </p>

                </div>

                <div class="p-6 space-y-3">

                    <a href="{{ route('finance.partner.dashboard') }}"
                        class="block rounded-xl bg-blue-600 text-white py-3 text-center font-semibold hover:bg-blue-700 transition">

                        Dashboard

                    </a>

                    <a href="{{ route('finance.partner.requests') }}"
                        class="block w-full px-4 py-3 rounded-xl font-medium text-center transition duration-300
                        {{ request()->routeIs('finance.partner.requests')
                            ? 'bg-blue-600 text-white shadow-lg'
                            : 'border border-gray-300 text-gray-700 hover:bg-blue-50 hover:border-blue-500 hover:text-blue-600' }}">

                        📄 Finance Requests

                    </a>

                    <a href="{{ route('import.finance.partner.requests') }}"
                        class="block w-full px-4 py-3 rounded-xl font-medium text-center transition duration-300
                        {{ request()->routeIs('import.finance.partner.requests')
                            ? 'bg-blue-600 text-white shadow-lg'
                            : 'border border-gray-300 text-gray-700 hover:bg-blue-50 hover:border-blue-500 hover:text-blue-600' }}">

                        📄 Import Finance Requests

                    </a>

                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf

                        <button
                            class="w-full rounded-xl bg-red-600 py-3 text-white font-semibold hover:bg-red-700 transition">

                            Logout

                        </button>

                    </form>

                </div>

            </div>





            {{-- Main Content --}}

            <div class="md:col-span-3">


                <div class="bg-white rounded-2xl shadow-lg p-6">

                    <h1 class="text-3xl font-bold">

                        Welcome,
                        <span class="text-blue-600">
                            {{ auth()->user()->name }}
                        </span>

                    </h1>

                    <p class="text-gray-500 mt-2">
                        Manage finance requests from customers.
                    </p>

                </div>




                {{-- Statistics --}}


                <div class="grid md:grid-cols-3 gap-6 mt-6">

                    <div
                        class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition">

                        <p>Total Requests</p>

                        <h2 class="text-4xl font-bold mt-2">

                            {{ $requests->count() }}

                        </h2>

                    </div>

                    <div
                        class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition">

                        <p>Pending</p>

                        <h2 class="text-4xl font-bold mt-2">

                            {{ $requests->where('status', 'Pending')->count() }}

                        </h2>

                    </div>

                    <div
                        class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition">

                        <p>Approved</p>

                        <h2 class="text-4xl font-bold mt-2">

                            {{ $requests->where('status', 'Approved')->count() }}

                        </h2>

                    </div>

                </div>







                {{-- Finance Requests Table --}}


                <div class="bg-white shadow rounded-lg mt-6">


                    <div class="border-b px-6 py-4">


                        <h5 class="text-lg font-semibold">

                            Customer Finance Requests

                        </h5>


                    </div>





                    <div class="p-6 overflow-x-auto">



                        <table class="w-full border-collapse">

                            <thead>
                                <tr class="bg-gray-800 text-white">

                                    <th class="px-4 py-3 text-left">
                                        Customer
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Car
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Amount
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Status
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Action
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                @forelse($requests as $request)
                                    <tr class="border-b hover:bg-gray-50">

                                        <td class="px-4 py-3">
                                            <div class="font-semibold">
                                                {{ $request->user->name }}
                                            </div>

                                            <small class="text-gray-500">
                                                {{ $request->user->email }}
                                            </small>
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $request->car->carBrand->name ?? '' }}
                                            {{ $request->car->title ?? '' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ number_format(($request->car->price - $request->down_payment), 2) }}
                                        </td>

                                        <td class="px-4 py-3">

                                            @if ($request->status == 'Approved')
                                                <span
                                                    class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                                    ✔ Approved
                                                </span>
                                            @elseif($request->status == 'Rejected')
                                                <span
                                                    class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                                    ✖ Rejected
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                                    ⏳ Pending
                                                </span>
                                            @endif

                                        </td>

                                        <td class="px-4 py-3">

                                            <div class="flex items-center gap-2">

                                                @if ($request->status == 'Pending')
                                                    <form action="{{ route('finance.partner.approve', $request->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                                                            ✓ Approve
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('finance.partner.reject', $request->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                                                            ✕ Reject
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-500 text-sm">
                                                        No Action
                                                    </span>
                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-gray-500">
                                            No Requests Found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>




                    </div>


                </div>





            </div>



        </div>



    </div>



</body>

</html>
