<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Car Import Request') }} | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-100">


    <div class="min-h-screen flex items-center justify-center py-12 px-4">


        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">


            @include('ai_layer.ai_language_translate')

            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2">
                {{ translate('Car Import Request') }}
            </h2>

            <p class="text-center text-gray-500 mb-8">
                {{ translate('Car Import Description') }}
            </p>


            <!-- Country -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ translate('Select Country') }}
                </label>

                <select name="country" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

                    <option value="">
                        {{ translate('Choose Country') }}
                    </option>

                    <option value="Japan">
                        {{ translate('Japan') }}
                    </option>

                    <option value="Germany">
                        {{ translate('Germany') }}
                    </option>

                    <option value="USA">
                        {{ translate('USA') }}
                    </option>

                    <option value="South Korea">
                        {{ translate('South Korea') }}
                    </option>

                    <option value="United Kingdom">
                        {{ translate('United Kingdom') }}
                    </option>

                </select>

            </div>


            <!-- Car Name -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ translate('Car Name') }}
                </label>

                <input type="text" name="car_name" placeholder="{{ translate('Car Name Placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3" required>

            </div>


            <!-- Budget -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ translate('Budget') }}
                </label>

                <input type="number" name="budget" placeholder="{{ translate('Budget Placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3" required>

            </div>


            <!-- Notes -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ translate('Additional Notes') }}
                </label>

                <textarea name="notes" rows="5" placeholder="{{ translate('Notes Placeholder') }}"
                    class="w-full border rounded-lg px-4 py-3"></textarea>

            </div>


            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">

                {{ translate('Submit Import Request') }}

            </button>


            </form>


        </div>


    </div>


</body>

</html>
