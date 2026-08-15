<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loyalty Rewards</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-10 px-5">

        <div class="flex
                justify-between
                items-center
                mb-8">

            <div>

                <h1 class="text-3xl
                       font-bold">

                    Loyalty Rewards

                </h1>

                <p class="text-gray-500 mt-2">
                    Manage customer loyalty rewards.
                </p>

            </div>


            <a href="{{ route('admin.loyalty.rewards.create') }}"
                class="bg-indigo-600
                   hover:bg-indigo-700
                   text-white
                   px-5 py-3
                   rounded-lg
                   font-semibold">

                + Create Reward

            </a>

        </div>


        @if (session('success'))
            <div
                class="bg-green-100
                    text-green-700
                    px-5 py-3
                    rounded-lg
                    mb-6">

                {{ session('success') }}

            </div>
        @endif


        <div class="bg-white
                rounded-2xl
                shadow
                overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Reward
                            </th>

                            <th class="px-6 py-4 text-left">
                                Points
                            </th>

                            <th class="px-6 py-4 text-left">
                                Discount
                            </th>

                            <th class="px-6 py-4 text-left">
                                Usage
                            </th>

                            <th class="px-6 py-4 text-left">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($rewards as $reward)
                            <tr class="border-t">

                                <td class="px-6 py-4">

                                    <p class="font-semibold">
                                        {{ $reward->name }}
                                    </p>

                                    <p class="text-sm
                                          text-gray-500">

                                        {{ $reward->coupon_code }}

                                    </p>

                                </td>


                                <td class="px-6 py-4">

                                    {{ number_format($reward->points_required) }}

                                </td>


                                <td class="px-6 py-4">

                                    @if ($reward->discount_percentage)
                                        {{ $reward->discount_percentage }}%
                                    @elseif($reward->discount_amount)
                                        {{ number_format($reward->discount_amount, 2) }}
                                    @else
                                        —
                                    @endif

                                </td>


                                <td class="px-6 py-4">

                                    {{ $reward->used_count }}

                                    /

                                    {{ $reward->usage_limit ?? '∞' }}

                                </td>


                                <td class="px-6 py-4">

                                    @if ($reward->status)
                                        <span
                                            class="bg-green-100
                                                 text-green-700
                                                 px-3 py-1
                                                 rounded-full
                                                 text-sm">

                                            Active

                                        </span>
                                    @else
                                        <span
                                            class="bg-red-100
                                                 text-red-700
                                                 px-3 py-1
                                                 rounded-full
                                                 text-sm">

                                            Inactive

                                        </span>
                                    @endif

                                </td>


                                <td class="px-6 py-4">

                                    <div
                                        class="flex
                                            justify-end
                                            gap-2">

                                        <a href="{{ route('admin.loyalty.rewards.edit', $reward->id) }}"
                                            class="bg-blue-100
                                               text-blue-700
                                               px-3 py-2
                                               rounded-lg">

                                            Edit

                                        </a>


                                        <form
                                            action="{{ route('admin.loyalty.rewards.destroy', $reward->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                onclick="return confirm(
                                                'Delete this reward?'
                                            )"
                                                class="bg-red-100
                                                   text-red-700
                                                   px-3 py-2
                                                   rounded-lg">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center
                                       py-10
                                       text-gray-500">

                                    No rewards found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="p-5">

                {{ $rewards->links() }}

            </div>

        </div>

    </div>

</body>

</html>
