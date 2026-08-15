<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Loyalty Reward</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto py-10 px-5">

        <div class="bg-white
                rounded-2xl
                shadow
                p-8">

            <h1 class="text-3xl
                   font-bold
                   mb-8">

                Create Loyalty Reward

            </h1>


            <form action="{{ route('admin.loyalty.rewards.store') }}" method="POST">

                @csrf


                <div class="mb-5">

                    <label class="block
                              font-semibold
                              mb-2">

                        Reward Name

                    </label>

                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full
                           border
                           rounded-lg
                           px-4 py-3">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label class="block
                              font-semibold
                              mb-2">

                        Description

                    </label>

                    <textarea name="description" rows="4"
                        class="w-full
                           border
                           rounded-lg
                           px-4 py-3">{{ old('description') }}</textarea>

                </div>


                <div class="mb-5">

                    <label class="block
                              font-semibold
                              mb-2">

                        Required Points

                    </label>

                    <input type="number" name="points_required" min="1" value="{{ old('points_required') }}"
                        required
                        class="w-full
                           border
                           rounded-lg
                           px-4 py-3">

                </div>


                <div
                    class="grid
                        md:grid-cols-2
                        gap-5
                        mb-5">

                    <div>

                        <label
                            class="block
                                  font-semibold
                                  mb-2">

                            Discount %

                        </label>

                        <input type="number" step="0.01" name="discount_percentage"
                            value="{{ old('discount_percentage') }}"
                            class="w-full
                               border
                               rounded-lg
                               px-4 py-3">

                    </div>


                    <div>

                        <label
                            class="block
                                  font-semibold
                                  mb-2">

                            Fixed Discount

                        </label>

                        <input type="number" step="0.01" name="discount_amount" value="{{ old('discount_amount') }}"
                            class="w-full
                               border
                               rounded-lg
                               px-4 py-3">

                    </div>

                </div>


                <div class="mb-5">

                    <label class="block
                              font-semibold
                              mb-2">

                        Usage Limit

                    </label>

                    <input type="number" name="usage_limit" min="1" value="{{ old('usage_limit') }}"
                        class="w-full
                           border
                           rounded-lg
                           px-4 py-3">

                </div>


                <div class="mb-8">

                    <label class="block
                              font-semibold
                              mb-2">

                        Expiry Date

                    </label>

                    <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                        class="w-full
                           border
                           rounded-lg
                           px-4 py-3">

                </div>


                <div class="flex gap-3">

                    <button type="submit"
                        class="bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           px-6 py-3
                           rounded-lg
                           font-semibold">

                        Create Reward

                    </button>

                    <a href="{{ route('admin.loyalty.rewards.index') }}"
                        class="bg-gray-200
                           px-6 py-3
                           rounded-lg">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
