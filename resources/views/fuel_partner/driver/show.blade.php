<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage Drivers | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto
               px-4 py-10">


        {{-- Header --}}

        <div
            class="flex
                   flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-4
                   mb-8">

            <div>

                <p class="text-gray-500">
                    Fuel Partner
                </p>

                <h1 class="text-3xl
                           font-bold
                           text-gray-900">
                    Delivery Drivers
                </h1>

                <p class="text-gray-500
                           mt-1">
                    {{ $partner->company_name }}
                </p>

            </div>


            <div class="flex
                       flex-wrap
                       gap-3">

                <a href="{{ route('fuel.partner.dashboard') }}"
                    class="border
                           bg-white
                           px-5 py-3
                           rounded-lg
                           font-semibold">
                    Dashboard
                </a>


                <a href="{{ route('fuel.partner.drivers.create') }}"
                    class="bg-red-600
                           hover:bg-red-700
                           text-white
                           px-5 py-3
                           rounded-lg
                           font-semibold">
                    + Add Driver
                </a>

            </div>

        </div>



        {{-- Success --}}

        @if (session('success'))
            <div
                class="bg-green-100
                       border border-green-300
                       text-green-700
                       px-4 py-3
                       rounded-lg
                       mb-6">

                {{ session('success') }}

            </div>
        @endif



        {{-- Drivers Table --}}

        <div
            class="bg-white
                   rounded-2xl
                   shadow
                   overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50
                               border-b">

                        <tr>

                            <th
                                class="px-6 py-4
                                       text-left
                                       text-sm
                                       font-semibold">
                                Driver
                            </th>

                            <th
                                class="px-6 py-4
                                       text-left
                                       text-sm
                                       font-semibold">
                                Phone
                            </th>

                            <th
                                class="px-6 py-4
                                       text-left
                                       text-sm
                                       font-semibold">
                                License
                            </th>

                            <th
                                class="px-6 py-4
                                       text-left
                                       text-sm
                                       font-semibold">
                                Vehicle
                            </th>

                            <th
                                class="px-6 py-4
                                       text-left
                                       text-sm
                                       font-semibold">
                                Status
                            </th>

                            <th
                                class="px-6 py-4
                                       text-right
                                       text-sm
                                       font-semibold">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($drivers as $driver)
                            <tr class="hover:bg-gray-50">


                                {{-- Driver --}}

                                <td class="px-6 py-4">

                                    <p
                                        class="font-semibold
                                               text-gray-900">
                                        {{ $driver->driver_name }}
                                    </p>

                                    <p class="text-sm
                                               text-gray-500">
                                        {{ $driver->user->email ?? 'N/A' }}
                                    </p>

                                </td>


                                {{-- Phone --}}

                                <td class="px-6 py-4
                                           text-gray-700">

                                    {{ $driver->phone ?? 'N/A' }}

                                </td>


                                {{-- License --}}

                                <td class="px-6 py-4">

                                    <p class="text-sm
                                               font-medium">
                                        {{ $driver->license_number ?? 'N/A' }}
                                    </p>

                                    @if ($driver->license_expiry)
                                        <p
                                            class="text-xs
                                                   text-gray-500">
                                            Exp:
                                            {{ \Carbon\Carbon::parse($driver->license_expiry)->format('d M Y') }}
                                        </p>
                                    @endif

                                </td>


                                {{-- Vehicle --}}

                                <td class="px-6 py-4">

                                    <p class="font-medium">
                                        {{ $driver->vehicle_number ?? 'N/A' }}
                                    </p>

                                    <p class="text-xs
                                               text-gray-500">
                                        {{ $driver->vehicle_type ?? '' }}
                                    </p>

                                </td>


                                {{-- Status --}}

                                <td class="px-6 py-4">

                                    <form method="POST"
                                        action="{{ route('fuel.partner.drivers.status', $driver->id) }}">

                                        @csrf

                                        @method('PUT')


                                        <select name="status" onchange="this.form.submit()"
                                            class="border
                                                   rounded-lg
                                                   px-3 py-2
                                                   text-sm">

                                            <option value="pending" @selected($driver->status === 'pending')>
                                                Pending
                                            </option>

                                            <option value="approved" @selected($driver->status === 'approved')>
                                                Approved
                                            </option>

                                            <option value="active" @selected($driver->status === 'active')>
                                                Active
                                            </option>

                                            <option value="inactive" @selected($driver->status === 'inactive')>
                                                Inactive
                                            </option>

                                            <option value="suspended" @selected($driver->status === 'suspended')>
                                                Suspended
                                            </option>

                                        </select>

                                    </form>

                                </td>


                                {{-- Actions --}}

                                <td class="px-6 py-4">

                                    <div class="flex
                                               justify-end">

                                        <form method="POST"
                                            action="{{ route('fuel.partner.drivers.destroy', $driver->id) }}"
                                            onsubmit="return confirm(
                                                'Are you sure you want to delete this driver?'
                                            );">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                class="bg-red-100
                                                       hover:bg-red-200
                                                       text-red-700
                                                       px-4 py-2
                                                       rounded-lg
                                                       font-semibold
                                                       text-sm">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="6"
                                    class="px-6 py-12
                                           text-center">

                                    <p class="text-gray-500
                                               mb-4">
                                        No delivery drivers found.
                                    </p>


                                    <a href="{{ route('fuel.partner.drivers.create') }}"
                                        class="inline-block
                                               bg-red-600
                                               text-white
                                               px-5 py-3
                                               rounded-lg
                                               font-semibold">
                                        + Add First Driver
                                    </a>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}

            @if ($drivers->hasPages())
                <div class="px-6 py-4
                           border-t">

                    {{ $drivers->links() }}

                </div>
            @endif

        </div>

    </div>

</body>

</html>
