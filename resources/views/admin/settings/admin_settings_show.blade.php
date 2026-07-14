<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Settings</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <div class="max-w-7xl mx-auto py-10 px-5">

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6 flex justify-between items-center">

                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Website Settings
                    </h1>

                    <p class="text-blue-100 mt-1">
                        Manage your website information
                    </p>
                </div>

                <a href="{{ route('admin.edit.setting', $setting->id) }}"
                    class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">
                    Update Setting
                </a>

            </div>

            <div class="p-8">

                <div class="grid lg:grid-cols-3 gap-10">

                    <!-- Left Side -->
                    <div class="lg:col-span-2">

                        <div class="overflow-hidden border rounded-lg">

                            <table class="w-full">

                                <tbody class="divide-y">

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 w-56 px-6 py-4">
                                            Website Name
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $setting->website_name ?: '-' }}
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 px-6 py-4">
                                            Email
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $setting->email ?: '-' }}
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 px-6 py-4">
                                            Phone
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $setting->phone ?: '-' }}
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 px-6 py-4">
                                            Address
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $setting->address ?: '-' }}
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 px-6 py-4">
                                            Facebook
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($setting->facebook)
                                                <a href="{{ $setting->facebook }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:underline">
                                                    {{ $setting->facebook }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 px-6 py-4">
                                            Instagram
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($setting->instagram)
                                                <a href="{{ $setting->instagram }}"
                                                    target="_blank"
                                                    class="text-pink-600 hover:underline">
                                                    {{ $setting->instagram }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="font-semibold bg-gray-50 px-6 py-4">
                                            Youtube
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($setting->youtube)
                                                <a href="{{ $setting->youtube }}"
                                                    target="_blank"
                                                    class="text-red-600 hover:underline">
                                                    {{ $setting->youtube }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <!-- Right Side -->
                    <div>

                        <div class="bg-gray-50 border rounded-xl p-6">

                            <h3 class="text-xl font-bold text-center mb-6">
                                Website Logo
                            </h3>

                            @if($setting->logo)

                                <div class="flex justify-center">

                                    <img src="{{ asset($setting->logo) }}"
                                        class="w-56 h-56 object-contain bg-white p-4 rounded-xl shadow border">

                                </div>

                            @else

                                <div
                                    class="w-56 h-56 mx-auto rounded-xl border-2 border-dashed flex items-center justify-center text-gray-400">

                                    No Logo Uploaded

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>