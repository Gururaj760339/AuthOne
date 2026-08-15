<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Earnings - AutoOne</title>

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

                    <a href="{{ route('partner.roadside.active') }}">
                        Active
                    </a>

                    <a href="{{ route('partner.roadside.completed') }}">
                        Completed
                    </a>

                    <a href="{{ route('partner.roadside.earnings') }}" class="text-purple-400">
                        Earnings
                    </a>

                </div>

            </div>

        </div>

    </nav>


    <main class="max-w-7xl mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold">
            Earnings
        </h1>

        <p class="text-slate-500 mt-1 mb-8">
            Track your roadside assistance earnings.
        </p>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    Total Earnings
                </p>

                <h2 class="text-3xl font-bold mt-2 text-green-600">
                    ${{ number_format($totalEarnings, 2) }}
                </h2>

            </div>


            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    This Month
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    ${{ number_format($monthlyEarnings, 2) }}
                </h2>

            </div>


            <div class="bg-white rounded-2xl border p-6">

                <p class="text-sm text-slate-500">
                    Completed Services
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    {{ $completedServices }}
                </h2>

            </div>

        </div>


        <div class="bg-white rounded-2xl border overflow-hidden">

            <div class="p-6 border-b">

                <h2 class="text-xl font-bold">
                    Earnings History
                </h2>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="text-left px-6 py-4">
                                Request
                            </th>

                            <th class="text-left px-6 py-4">
                                Service
                            </th>

                            <th class="text-left px-6 py-4">
                                Date
                            </th>

                            <th class="text-right px-6 py-4">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($earnings as $earning)
                            <tr>

                                <td class="px-6 py-4 font-semibold">
                                    #RA-{{ $earning->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ ucwords(str_replace('_', ' ', $earning->assistance_type)) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ optional($earning->completed_at)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-right font-bold text-green-600">
                                    ${{ number_format($earning->final_cost ?? 0, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-12 text-slate-500">

                                    No earnings available.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</body>

</html>
