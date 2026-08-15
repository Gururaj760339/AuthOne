<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cross-Border Countries</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Cross-Border Countries
                </h1>

                <p class="text-gray-500">
                    Manage GCC, Egypt and North Africa markets
                </p>
            </div>

            <a href="{{ route('admin.countries.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                + Add Country
            </a>

        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">Country</th>
                            <th class="px-4 py-3">Code</th>
                            <th class="px-4 py-3">Region</th>
                            <th class="px-4 py-3">Currency</th>
                            <th class="px-4 py-3">Language</th>
                            <th class="px-4 py-3">VAT</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($countries as $country)

                            <tr class="border-t">

                                <td class="px-4 py-4 font-semibold">
                                    {{ $country->name }}
                                </td>

                                <td class="px-4 py-4 text-center">
                                    {{ $country->code }}
                                </td>

                                <td class="px-4 py-4 text-center">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded">
                                        {{ $country->region }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 text-center">
                                    {{ $country->currency_code }}
                                    {{ $country->currency_symbol }}
                                </td>

                                <td class="px-4 py-4 text-center">
                                    {{ $country->default_locale }}
                                </td>

                                <td class="px-4 py-4 text-center">
                                    {{ $country->vat_rate }}%
                                </td>

                                <td class="px-4 py-4 text-center">

                                    @if($country->is_active)

                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                            Active
                                        </span>

                                    @else

                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-4">

                                    <div class="flex gap-2">

                                        <a href="{{ route('admin.countries.edit', $country) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.countries.destroy', $country) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this country?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8"
                                    class="text-center py-8 text-gray-500">
                                    No countries found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>