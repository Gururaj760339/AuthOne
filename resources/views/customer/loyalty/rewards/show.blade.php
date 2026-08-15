<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Loyalty Rewards</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-5 py-10">

        {{-- Header --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800">
                Loyalty Rewards
            </h1>

            <p class="text-gray-500 mt-2">
                Earn points and redeem exclusive rewards.
            </p>

        </div>


        {{-- Messages --}}

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


        @if (session('error'))
            <div
                class="bg-red-100
                        text-red-700
                        px-5 py-3
                        rounded-lg
                        mb-6">

                {{ session('error') }}

            </div>
        @endif


        {{-- Points Card --}}

        <div
            class="bg-white
                    rounded-2xl
                    shadow
                    p-8
                    mb-10">

            <div
                class="flex
                        flex-col
                        md:flex-row
                        justify-between
                        items-center
                        gap-5">

                <div>

                    <p class="text-gray-500">
                        Your Loyalty Points
                    </p>

                    <h2
                        class="text-5xl
                               font-bold
                               text-indigo-600
                               mt-2">

                        {{ number_format($loyalty->points) }}

                    </h2>

                    <p class="text-gray-400 mt-2">
                        Points available
                    </p>

                </div>

                <div class="text-6xl">
                    🎁
                </div>

            </div>

        </div>


        {{-- Rewards --}}

        <div class="mb-10">

            <h2
                class="text-2xl
                       font-bold
                       text-gray-800
                       mb-5">

                Available Rewards

            </h2>


            <div
                class="grid
                        grid-cols-1
                        md:grid-cols-2
                        lg:grid-cols-3
                        gap-6">

                @forelse($rewards as $reward)
                    <div
                        class="bg-white
                                rounded-2xl
                                shadow
                                p-6">

                        <div
                            class="flex
                                    justify-between
                                    items-start">

                            <div>

                                <h3
                                    class="text-xl
                                           font-bold
                                           text-gray-800">

                                    {{ $reward->name }}

                                </h3>

                                <p
                                    class="text-gray-500
                                          text-sm
                                          mt-2">

                                    {{ $reward->description }}

                                </p>

                            </div>

                            <span class="text-3xl">
                                🎁
                            </span>

                        </div>


                        {{-- Discount --}}

                        @if ($reward->discount_percentage)
                            <div
                                class="mt-5
                                        bg-green-50
                                        text-green-700
                                        px-4 py-3
                                        rounded-lg">

                                {{ $reward->discount_percentage }}%
                                Discount

                            </div>
                        @elseif($reward->discount_amount)
                            <div
                                class="mt-5
                                        bg-green-50
                                        text-green-700
                                        px-4 py-3
                                        rounded-lg">

                                Discount:
                                {{ number_format($reward->discount_amount, 2) }}

                            </div>
                        @endif


                        <div class="mt-5">

                            <p class="font-semibold
                                      text-gray-700">

                                {{ number_format($reward->points_required) }}
                                Points

                            </p>

                        </div>


                        @if ($reward->expires_at)
                            <p
                                class="text-sm
                                      text-gray-400
                                      mt-2">

                                Expires:
                                {{ $reward->expires_at->format('d M Y') }}

                            </p>
                        @endif


                        <form action="{{ route('customer.loyalty.redeem', $reward->id) }}" method="POST"
                            class="mt-5">

                            @csrf

                            <button type="submit"
                                class="w-full
                                       bg-indigo-600
                                       hover:bg-indigo-700
                                       text-white
                                       font-semibold
                                       py-3
                                       rounded-lg
                                       transition">

                                Redeem Reward

                            </button>

                        </form>

                    </div>

                @empty

                    <div
                        class="col-span-full
                                bg-white
                                rounded-xl
                                p-8
                                text-center">

                        <p class="text-gray-500">
                            No rewards available right now.
                        </p>

                    </div>
                @endforelse

            </div>

        </div>


        {{-- Transaction History --}}

        <div>

            <h2
                class="text-2xl
                       font-bold
                       text-gray-800
                       mb-5">

                Points History

            </h2>


            <div
                class="bg-white
                        rounded-2xl
                        shadow
                        overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="text-left
                                           px-6 py-4">

                                    Date

                                </th>

                                <th class="text-left
                                           px-6 py-4">

                                    Description

                                </th>

                                <th class="text-left
                                           px-6 py-4">

                                    Type

                                </th>

                                <th class="text-right
                                           px-6 py-4">

                                    Points

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($transactions as $transaction)
                                <tr class="border-t">

                                    <td class="px-6 py-4
                                               text-gray-600">

                                        {{ $transaction->created_at->format('d M Y') }}

                                    </td>

                                    <td class="px-6 py-4">

                                        {{ $transaction->description }}

                                    </td>

                                    <td class="px-6 py-4">

                                        <span
                                            class="px-3 py-1
                                                     rounded-full
                                                     text-sm
                                            {{ $transaction->points >= 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                                            {{ ucfirst($transaction->type) }}

                                        </span>

                                    </td>

                                    <td
                                        class="px-6 py-4
                                               text-right
                                               font-bold
                                            {{ $transaction->points >= 0 ? 'text-green-600' : 'text-red-600' }}">

                                        {{ $transaction->points > 0 ? '+' : '' }}
                                        {{ $transaction->points }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center
                                               px-6 py-8
                                               text-gray-500">

                                        No transaction history.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="p-5">

                    {{ $transactions->links() }}

                </div>

            </div>

        </div>

    </div>

</body>

</html>
