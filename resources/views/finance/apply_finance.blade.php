<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.apply_finance') }} | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center py-12 px-4">

        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8">

            @include('ai_layer.ai_language_translate')

            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2">
                {{ translate('Apply for Finance') }}
            </h2>

            <p class="text-center text-gray-500 mb-8">
                {{ translate('apply finance desc') }}
            </p>


            <form action="{{ route('customer.finance.request') }}" method="POST" class="space-y-6">

                @csrf


                <!-- Select Car -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('select car') }}
                    </label>

                    <select name="car_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                        required>

                        <option value="">
                            {{ translate('choose car') }}
                        </option>

                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}">
                                {{ translate($car->title) }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Full Name -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('Full Name') }}
                    </label>

                    <input type="text" name="full_name" placeholder="{{ translate('enter full name') }}"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>


                <!-- Email -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('Email Address') }}
                    </label>

                    <input type="email" name="email" placeholder="{{ translate('enter email') }}"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>


                <!-- Phone -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('Phone Number') }}
                    </label>

                    <input type="text" name="phone" placeholder="{{ translate('enter phone') }}"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>


                <!-- Salary -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('Monthly Salary') }}
                    </label>

                    <input type="number" name="salary" placeholder="{{ translate('salary placeholder') }}"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>


                <!-- Employment -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('Employment Status') }}
                    </label>

                    <select name="employment" class="w-full border rounded-lg px-4 py-3" required>

                        <option value="">
                            {{ translate('select employment') }}
                        </option>

                        <option value="Full Time">
                            {{ translate('full time') }}
                        </option>

                        <option value="Part Time">
                            {{ translate('part time') }}
                        </option>

                        <option value="Self Employed">
                            {{ translate('self employed') }}
                        </option>

                        <option value="Business Owner">
                            {{ translate('business owner') }}
                        </option>

                        <option value="Government Employee">
                            {{ translate('government employee') }}
                        </option>

                    </select>
                </div>


                <!-- Down Payment -->
                <div>
                    <label class="block font-semibold mb-2">
                        {{ translate('Down Payment') }}
                    </label>

                    <input type="number" name="down_payment"
                        placeholder="{{ translate('down payment placeholder') }}"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ translate('Select Finance Partner') }}
                    </label>

                    <select name="finance_partner_id"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl 
               text-gray-700 shadow-sm 
               focus:outline-none focus:ring-2 focus:ring-blue-500 
               focus:border-blue-500 transition duration-200">
                        <option value="" disabled selected>
                            {{ translate('choose finance partner') }}
                        </option>

                        @foreach ($partners as $partner)
                            <option value="{{ $partner->id }}">
                                {{ translate($partner->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">

                    {{ translate('submit finance') }}

                </button>


            </form>

        </div>

    </div>

</body>

</html>
