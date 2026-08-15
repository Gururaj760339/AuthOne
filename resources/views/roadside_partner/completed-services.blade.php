<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Completed Services - AutoOne</title>

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

                    <a href="{{ route('partner.roadside.completed') }}" class="text-green-400">
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
                Completed Services
            </h1>

            <p class="text-slate-500 mt-1">
                Your completed roadside assistance service history.
            </p>

        </div>


        <div class="bg-white rounded-2xl border overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b">

                        <tr>

                            <th class="text-left px-6 py-4 text-sm">
                                Request
                            </th>

                            <th class="text-left px-6 py-4 text-sm">
                                Customer
                            </th>

                            <th class="text-left px-6 py-4 text-sm">
                                Service
                            </th>

                            <th class="text-left px-6 py-4 text-sm">
                                Completed
                            </th>

                            <th class="text-left px-6 py-4 text-sm">
                                Amount
                            </th>

                            <th class="text-right px-6 py-4 text-sm">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($services as $service)
                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-5 font-bold">

                                    #RA-{{ $service->id }}

                                </td>


                                <td class="px-6 py-5">

                                    <p class="font-semibold">
                                        {{ $service->user->name ?? 'Customer' }}
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        {{ $service->user->phone ?? '' }}
                                    </p>

                                </td>


                                <td class="px-6 py-5">

                                    {{ ucwords(str_replace('_', ' ', $service->assistance_type)) }}

                                </td>


                                <td class="px-6 py-5 text-sm">

                                    {{ optional($service->completed_at)->format('d M Y') ?? 'N/A' }}
                                </td>


                                <td class="px-6 py-5 font-bold text-green-600">

                                    ${{ number_format($service->final_cost ?? 0, 2) }}

                                </td>


                                <td class="px-6 py-5 text-right">

                                    <a href="{{ route('partner.roadside.request.show', $service->id) }}"
                                        class="text-blue-600 font-semibold text-sm">

                                        View

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-16 text-center text-slate-500">

                                    No completed services yet.

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
