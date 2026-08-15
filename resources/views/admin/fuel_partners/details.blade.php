<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $partner->company_name }} | Admin | AutoOne
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-5xl mx-auto px-4 py-10">


        <div class="mb-6">

            <a href="{{ route('admin.fuel-partners.index') }}"
                class="text-red-600 hover:underline">
                ← Back to Fuel Partners
            </a>

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


        <div class="bg-white rounded-2xl shadow p-6 md:p-8">


            {{-- Header --}}

            <div
                class="flex flex-col md:flex-row
                   md:items-center
                   md:justify-between
                   gap-4 mb-8">

                <div>

                    <p class="text-gray-500">
                        Fuel Delivery Partner
                    </p>

                    <h1 class="text-3xl font-bold">
                        {{ $partner->company_name }}
                    </h1>

                </div>


                <span
                    class="px-4 py-2
                       rounded-full
                       bg-gray-100
                       font-semibold">
                    {{ ucfirst($partner->status) }}
                </span>

            </div>


            {{-- Partner Information --}}

            <div class="grid grid-cols-1
                   md:grid-cols-2
                   gap-6">


                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Email
                    </p>

                    <p class="font-semibold mt-1">

                        {{ $partner->email ?? ($partner->user->email ?? 'N/A') }}

                    </p>

                </div>


                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Phone
                    </p>

                    <p class="font-semibold mt-1">

                        {{ $partner->phone ?? 'N/A' }}

                    </p>

                </div>


                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        License Number
                    </p>

                    <p class="font-semibold mt-1">

                        {{ $partner->license_number ?? 'N/A' }}

                    </p>

                </div>


                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        License Expiry
                    </p>

                    <p class="font-semibold mt-1">

                        {{ optional($partner->license_expiry)->format('d M Y') ?? 'N/A' }}

                    </p>

                </div>


                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        City
                    </p>

                    <p class="font-semibold mt-1">

                        {{ $partner->city ?? 'N/A' }}

                    </p>

                </div>


                <div class="border rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Commission Rate
                    </p>

                    <p class="font-semibold
                           text-red-600
                           mt-1">

                        {{ $partner->commission_rate }}%

                    </p>

                </div>

            </div>


            {{-- Address --}}

            <div class="mt-6 border rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Address
                </p>

                <p class="font-semibold mt-1">

                    {{ $partner->address ?? 'N/A' }}

                </p>

            </div>


            {{-- Actions --}}

            <div class="flex flex-wrap gap-3 mt-8">


                @if ($partner->status === 'pending')
                    <form
                        action="{{ route('admin.fuel-partners.approve', $partner->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                            class="bg-green-600
                               hover:bg-green-700
                               text-white
                               px-5 py-3
                               rounded-lg
                               font-semibold">
                            Approve Partner
                        </button>

                    </form>


                    <form
                        action="{{ route('admin.fuel-partners.reject', $partner->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                            class="bg-red-600
                               hover:bg-red-700
                               text-white
                               px-5 py-3
                               rounded-lg
                               font-semibold">
                            Reject Partner
                        </button>

                    </form>
                @elseif($partner->status === 'approved')
                    <form
                        action="{{ route('admin.fuel-partners.suspend', $partner->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                            class="bg-orange-600
                               hover:bg-orange-700
                               text-white
                               px-5 py-3
                               rounded-lg
                               font-semibold">
                            Suspend Partner
                        </button>

                    </form>
                @elseif($partner->status === 'suspended')
                    <form
                        action="{{ route('admin.fuel-partners.approve', $partner->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                            class="bg-green-600
                               hover:bg-green-700
                               text-white
                               px-5 py-3
                               rounded-lg
                               font-semibold">
                            Reactivate Partner
                        </button>

                    </form>
                @endif

            </div>

        </div>

    </div>

</body>

</html>
