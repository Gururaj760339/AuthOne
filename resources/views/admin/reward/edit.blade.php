<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Loyalty Reward</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto py-10 px-5">

        <div class="bg-white rounded-2xl shadow p-8">

            {{-- Header --}}

            <div
                class="flex
                    justify-between
                    items-center
                    mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-gray-800">
                        Edit Loyalty Reward
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Update reward details and settings.
                    </p>

                </div>

                <a href="{{ route('admin.loyalty.rewards.index') }}"
                    class="bg-gray-200
                       hover:bg-gray-300
                       text-gray-700
                       px-5 py-3
                       rounded-lg
                       font-semibold">

                    Back

                </a>

            </div>


            {{-- Validation Errors --}}

            @if ($errors->any())

                <div
                    class="bg-red-50
                        border border-red-200
                        text-red-700
                        rounded-lg
                        p-4
                        mb-6">

                    <ul class="list-disc ml-5 space-y-1">

                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Success Message --}}

            @if (session('success'))
                <div
                    class="bg-green-50
                        border border-green-200
                        text-green-700
                        rounded-lg
                        p-4
                        mb-6">

                    {{ session('success') }}

                </div>
            @endif


            {{-- Form --}}

            <form
                action="{{ route('admin.loyalty.rewards.update', $reward->id) }}"
                method="POST">

                @csrf

                @method('PUT')


                {{-- Reward Name --}}

                <div class="mb-6">

                    <label for="name"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Reward Name

                    </label>

                    <input type="text" id="name" name="name"
                        value="{{ old('name', $reward->name) }}"
                        required maxlength="255"
                        class="w-full
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:border-indigo-500">

                </div>


                {{-- Description --}}

                <div class="mb-6">

                    <label for="description"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Description

                    </label>

                    <textarea id="description" name="description" rows="4"
                        class="w-full
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:border-indigo-500">{{ old('description', $reward->description) }}</textarea>

                </div>


                {{-- Points Required --}}

                <div class="mb-6">

                    <label for="points_required"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Required Points

                    </label>

                    <input type="number" id="points_required" name="points_required" min="1"
                        value="{{ old('points_required', $reward->points_required) }}"
                        required
                        class="w-full
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:border-indigo-500">

                    <p class="text-xs
                          text-gray-500
                          mt-2">

                        Number of loyalty points required
                        to redeem this reward.

                    </p>

                </div>


                {{-- Discount Section --}}

                <div class="mb-6">

                    <h2
                        class="text-lg
                           font-bold
                           text-gray-800
                           mb-4">

                        Discount Settings

                    </h2>


                    <div
                        class="grid
                            grid-cols-1
                            md:grid-cols-2
                            gap-5">

                        {{-- Percentage --}}

                        <div>

                            <label for="discount_percentage"
                                class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                                Discount Percentage (%)

                            </label>

                            <input type="number" id="discount_percentage" name="discount_percentage" min="0"
                                max="100" step="0.01"
                                value="{{ old('discount_percentage', $reward->discount_percentage) }}"
                                class="w-full
                                   border
                                   border-gray-300
                                   rounded-lg
                                   px-4 py-3
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:border-indigo-500">

                            <p
                                class="text-xs
                                  text-gray-500
                                  mt-2">

                                Example: 10 means 10% discount.

                            </p>

                        </div>


                        {{-- Fixed Amount --}}

                        <div>

                            <label for="discount_amount"
                                class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                                Fixed Discount Amount

                            </label>

                            <input type="number" id="discount_amount" name="discount_amount" min="0"
                                step="0.01"
                                value="{{ old('discount_amount', $reward->discount_amount) }}"
                                class="w-full
                                   border
                                   border-gray-300
                                   rounded-lg
                                   px-4 py-3
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:border-indigo-500">

                            <p
                                class="text-xs
                                  text-gray-500
                                  mt-2">

                                Use either percentage or fixed discount.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Coupon Code --}}

                <div class="mb-6">

                    <label for="coupon_code"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Coupon Code

                    </label>

                    <input type="text" id="coupon_code" value="{{ $reward->coupon_code }}" readonly
                        class="w-full
                           bg-gray-100
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           text-gray-600">

                    <p class="text-xs
                          text-gray-500
                          mt-2">

                        Coupon code cannot be changed here.

                    </p>

                </div>


                {{-- Usage Limit --}}

                <div class="mb-6">

                    <label for="usage_limit"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Usage Limit

                    </label>

                    <input type="number" id="usage_limit" name="usage_limit" min="1"
                        value="{{ old('usage_limit', $reward->usage_limit) }}"
                        class="w-full
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:border-indigo-500">

                    <p class="text-xs
                          text-gray-500
                          mt-2">

                        Leave empty for unlimited usage.

                    </p>

                </div>


                {{-- Used Count --}}

                <div class="mb-6">

                    <label
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Used Count

                    </label>

                    <div
                        class="bg-gray-100
                            border
                            border-gray-300
                            rounded-lg
                            px-4 py-3
                            text-gray-700">

                        {{ $reward->used_count }}

                    </div>

                    <p class="text-xs
                          text-gray-500
                          mt-2">

                        This value is automatically managed by the system.

                    </p>

                </div>


                {{-- Expiry Date --}}

                <div class="mb-6">

                    <label for="expires_at"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Expiry Date

                    </label>

                    <input type="date" id="expires_at" name="expires_at"
                        value="{{ old('expires_at', $reward->expires_at ? $reward->expires_at->format('Y-m-d') : '') }}"
                        class="w-full
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:border-indigo-500">

                    <p class="text-xs
                          text-gray-500
                          mt-2">

                        Leave empty if the reward has no expiry date.

                    </p>

                </div>


                {{-- Status --}}

                <div class="mb-8">

                    <label for="status"
                        class="block
                           text-sm
                           font-semibold
                           text-gray-700
                           mb-2">

                        Status

                    </label>

                    <select id="status" name="status" required
                        class="w-full
                           border
                           border-gray-300
                           rounded-lg
                           px-4 py-3
                           focus:ring-2
                           focus:ring-indigo-500
                           focus:border-indigo-500">

                        <option value="1"
                            {{ old('status', $reward->status) == 1 ? 'selected' : '' }}>

                            Active

                        </option>

                        <option value="0"
                            {{ old('status', $reward->status) == 0 ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>


                {{-- Buttons --}}

                <div
                    class="flex
                        flex-col
                        sm:flex-row
                        gap-3">

                    <button type="submit"
                        class="bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           px-6 py-3
                           rounded-lg
                           font-semibold
                           transition">

                        Update Reward

                    </button>


                    <a href="{{ route('admin.loyalty.rewards.index') }}"
                        class="bg-gray-200
                           hover:bg-gray-300
                           text-gray-700
                           px-6 py-3
                           rounded-lg
                           font-semibold
                           text-center">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
