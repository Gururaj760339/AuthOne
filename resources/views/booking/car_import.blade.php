<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.car_import_request') }} | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-100">


    <div class="min-h-screen flex items-center justify-center py-12 px-4">


        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">


            @include('language_drop_down')

            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2">
                {{ __('messages.car_import_request') }}
            </h2>

            <p class="text-center text-gray-500 mb-8">
                {{ __('messages.car_import_desc') }}
            </p>


            <!-- Country -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.select_country') }}
                </label>

                <select name="country" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

                    <option value="">
                        {{ __('messages.choose_country') }}
                    </option>

                    <option value="Japan">
                        {{ __('messages.japan') }}
                    </option>

                    <option value="Germany">
                        {{ __('messages.germany') }}
                    </option>

                    <option value="USA">
                        {{ __('messages.usa') }}
                    </option>

                    <option value="South Korea">
                        {{ __('messages.south_korea') }}
                    </option>

                    <option value="United Kingdom">
                        {{ __('messages.united_kingdom') }}
                    </option>

                </select>

            </div>


            <!-- Car Name -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.car_name_model') }}
                </label>

                <input type="text" name="car_name" placeholder="{{ __('messages.car_name_placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3" required>

            </div>


            <!-- Budget -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.budget') }}
                </label>

                <input type="number" name="budget" placeholder="{{ __('messages.budget_placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3" required>

            </div>


            <!-- Notes -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.additional_notes') }}
                </label>

                <textarea name="notes" rows="5" placeholder="{{ __('messages.notes_placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3"></textarea>

            </div>


            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">

                {{ __('messages.submit_import_request') }}

            </button>


            </form>


        </div>


    </div>


</body>

</html>
