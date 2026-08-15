<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fuel Partners | Admin | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-10">


        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800">
                Fuel Delivery Partners
            </h1>

            <p class="text-gray-500 mt-1">
                Manage fuel delivery partners.
            </p>

        </div>


        @if (session('success'))
            <div
                class="bg-green-100
                   border border-green-300
                   text-green-700
                   px-4 py-3
                   rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif


        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-5 py-4 text-left">
                                Company
                            </th>

                            <th class="px-5 py-4 text-left">
                                Contact
                            </th>

                            <th class="px-5 py-4 text-left">
                                License
                            </th>

                            <th class="px-5 py-4 text-left">
                                Commission
                            </th>

                            <th class="px-5 py-4 text-left">
                                Status
                            </th>

                            <th class="px-5 py-4 text-left">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($partners as $partner)
                            <tr class="hover:bg-gray-50">

                                <td class="px-5 py-4">

                                    <div class="font-semibold">
                                        {{ $partner->company_name }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $partner->city ?? 'N/A' }}
                                    </div>

                                </td>


                                <td class="px-5 py-4">

                                    <div>
                                        {{ $partner->phone ?? 'N/A' }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $partner->email ?? ($partner->user->email ?? 'N/A') }}
                                    </div>

                                </td>


                                <td class="px-5 py-4">

                                    {{ $partner->license_number ?? 'N/A' }}

                                </td>


                                <td class="px-5 py-4">

                                    {{ $partner->commission_rate }}%

                                </td>


                                <td class="px-5 py-4">

                                    <span
                                        class="px-3 py-1
                                           rounded-full
                                           bg-gray-100
                                           text-xs
                                           font-semibold">

                                        {{ ucfirst($partner->status) }}

                                    </span>

                                </td>


                                <td class="px-5 py-4">

                                    <a href="{{ route('admin.fuel-partners.show', $partner->id) }}"
                                        class="bg-blue-600
                                           hover:bg-blue-700
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

                                <td colspan="6"
                                    class="px-6 py-12
                                       text-center
                                       text-gray-500">
                                    No fuel partners found.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <div class="mt-6">
            {{ $partners->links() }}
        </div>

    </div>

</body>

</html>
