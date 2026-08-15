<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Country</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="max-w-3xl mx-auto px-4 py-8">

        <div class="bg-white shadow rounded-2xl p-6">

            <h1 class="text-2xl font-bold mb-6">
                Add Country
            </h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-5">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.countries.store') }}">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block mb-2 font-medium">
                            Country Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            ISO Code
                        </label>

                        <input type="text" name="code" value="{{ old('code') }}" placeholder="AE" maxlength="2"
                            class="w-full border rounded-lg px-4 py-2 uppercase" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            ISO3
                        </label>

                        <input type="text" name="iso3" value="{{ old('iso3') }}" placeholder="ARE"
                            maxlength="3" class="w-full border rounded-lg px-4 py-2 uppercase">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Phone Code
                        </label>

                        <input type="text" name="phone_code" value="{{ old('phone_code') }}" placeholder="+971"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Currency Code
                        </label>

                        <input type="text" name="currency_code" value="{{ old('currency_code') }}" placeholder="AED"
                            maxlength="3" class="w-full border rounded-lg px-4 py-2 uppercase" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Currency Symbol
                        </label>

                        <input type="text" name="currency_symbol" value="{{ old('currency_symbol') }}"
                            placeholder="د.إ" class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Default Language
                        </label>

                        <select name="default_locale" class="w-full border rounded-lg px-4 py-2">

                            <option value="en" {{ old('default_locale') == 'en' ? 'selected' : '' }}>
                                English
                            </option>

                            <option value="ar" {{ old('default_locale') == 'ar' ? 'selected' : '' }}>
                                Arabic
                            </option>

                            <option value="fr" {{ old('default_locale') == 'fr' ? 'selected' : '' }}>
                                French
                            </option>

                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Region
                        </label>

                        <select name="region" class="w-full border rounded-lg px-4 py-2" required>

                            <option value="GCC" {{ old('region') == 'GCC' ? 'selected' : '' }}>
                                GCC
                            </option>

                            <option value="Egypt" {{ old('region') == 'Egypt' ? 'selected' : '' }}>
                                Egypt
                            </option>

                            <option value="North Africa" {{ old('region') == 'North Africa' ? 'selected' : '' }}>
                                North Africa
                            </option>

                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            VAT Rate (%)
                        </label>

                        <input type="number" name="vat_rate" step="0.01" min="0" max="100"
                            value="{{ old('vat_rate', 0) }}" class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Timezone
                        </label>

                        <input type="text" name="timezone" value="{{ old('timezone') }}" placeholder="Asia/Dubai"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                </div>

                <div class="mt-5">

                    <label class="flex items-center gap-2">

                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', 1) ? 'checked' : '' }}>

                        <span>Active Country</span>

                    </label>

                </div>

                <div class="flex gap-3 mt-7">

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Save Country
                    </button>

                    <a href="{{ route('admin.countries.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
