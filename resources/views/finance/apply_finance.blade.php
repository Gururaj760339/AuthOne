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

        @include('language_drop_down')

        <h2 class="text-3xl font-bold text-center text-slate-800 mb-2">
            {{ __('messages.apply_finance') }}
        </h2>

        <p class="text-center text-gray-500 mb-8">
            {{ __('messages.apply_finance_desc') }}
        </p>


        <form action="#" method="POST" class="space-y-6">

            @csrf


            <!-- Select Car -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.select_car') }}
                </label>

                <select
                    name="car_id"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

                    <option value="">
                        {{ __('messages.choose_car') }}
                    </option>

                    <option value="1">
                        Toyota Corolla 2022
                    </option>

                    <option value="2">
                        Honda Civic 2021
                    </option>

                    <option value="3">
                        BMW X5 2023
                    </option>

                    <option value="4">
                        Mercedes C-Class 2022
                    </option>

                    <option value="5">
                        Hyundai Tucson 2024
                    </option>

                </select>
            </div>


            <!-- Full Name -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.full_name') }}
                </label>

                <input
                    type="text"
                    name="full_name"
                    placeholder="{{ __('messages.enter_full_name') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>


            <!-- Email -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.email_address') }}
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="{{ __('messages.enter_email') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>


            <!-- Phone -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.phone_number') }}
                </label>

                <input
                    type="text"
                    name="phone"
                    placeholder="{{ __('messages.phone_placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>


            <!-- Salary -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.monthly_salary') }}
                </label>

                <input
                    type="number"
                    name="salary"
                    placeholder="{{ __('messages.salary_placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>


            <!-- Employment -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.employment_status') }}
                </label>

                <select
                    name="employment"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                    <option value="">
                        {{ __('messages.select_employment') }}
                    </option>

                    <option value="Full Time">
                        {{ __('messages.full_time') }}
                    </option>

                    <option value="Part Time">
                        {{ __('messages.part_time') }}
                    </option>

                    <option value="Self Employed">
                        {{ __('messages.self_employed') }}
                    </option>

                    <option value="Business Owner">
                        {{ __('messages.business_owner') }}
                    </option>

                    <option value="Government Employee">
                        {{ __('messages.government_employee') }}
                    </option>

                </select>
            </div>


            <!-- Down Payment -->
            <div>
                <label class="block font-semibold mb-2">
                    {{ __('messages.down_payment') }}
                </label>

                <input
                    type="number"
                    name="down_payment"
                    placeholder="{{ __('messages.down_payment_placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>
            </div>


            <!-- Submit -->
            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">

                {{ __('messages.submit_finance') }}

            </button>


        </form>

    </div>

</div>

</body>
</html>