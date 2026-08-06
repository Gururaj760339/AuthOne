<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Extended Warranty</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-12">

    <div class="bg-white shadow-lg rounded-lg">

        <div class="border-b px-6 py-4">
            <h2 class="text-2xl font-bold text-gray-800">
                Buy Extended Warranty
            </h2>
        </div>

        <div class="p-6">

            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.extended.warranty.store') }}" method="POST">

                @csrf

                <input type="hidden"
                       name="warranty_id"
                       value="{{ $warranty->id }}">

                <div class="mb-6">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select Warranty Plan
                    </label>

                    <select
                        name="warranty_plan_id"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>

                        <option value="">Choose Warranty Plan</option>

                        @foreach($plans as $plan)

                            <option value="{{ $plan->id }}">
                                {{ $plan->name }}
                                | {{ $plan->duration_months }} Months
                                | ${{ number_format($plan->price,2) }}
                            </option>

                        @endforeach

                    </select>

                </div>

                @if($plans->count())

                    <div class="overflow-x-auto mb-6">

                        <table class="min-w-full border border-gray-200">

                            <thead class="bg-gray-100">

                                <tr>
                                    <th class="border px-4 py-2 text-left">Plan</th>
                                    <th class="border px-4 py-2 text-left">Duration</th>
                                    <th class="border px-4 py-2 text-left">Price</th>
                                    <th class="border px-4 py-2 text-left">Max KM</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($plans as $plan)

                                    <tr class="hover:bg-gray-50">

                                        <td class="border px-4 py-2">
                                            {{ $plan->name }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $plan->duration_months }} Months
                                        </td>

                                        <td class="border px-4 py-2">
                                            ${{ number_format($plan->price,2) }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ number_format($plan->max_km) }} KM
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">

                    Buy Extended Warranty

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>