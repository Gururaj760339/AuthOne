<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Setting</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-3xl font-bold mb-8">
                Update Website Setting
            </h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.update.setting', $setting->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Website Name -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Website Name
                    </label>

                    <input
                        type="text"
                        name="website_name"
                        value="{{ old('website_name', $setting->website_name) }}"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $setting->email) }}"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Phone -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $setting->phone) }}"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Address -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('address', $setting->address) }}</textarea>
                </div>

                <!-- Facebook -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Facebook
                    </label>

                    <input
                        type="text"
                        name="facebook"
                        value="{{ old('facebook', $setting->facebook) }}"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Instagram -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Instagram
                    </label>

                    <input
                        type="text"
                        name="instagram"
                        value="{{ old('instagram', $setting->instagram) }}"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Youtube -->
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Youtube
                    </label>

                    <input
                        type="text"
                        name="youtube"
                        value="{{ old('youtube', $setting->youtube) }}"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Logo Upload -->
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Website Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        id="logo"
                        accept="image/*"
                        class="w-full border rounded-lg p-3">

                </div>

                <!-- Image Preview -->

                <div class="mb-8">

                    @if($setting->logo)

                        <img
                            id="preview"
                            src="{{ asset($setting->logo) }}"
                            class="w-44 h-44 object-cover rounded-lg border shadow">

                    @else

                        <img
                            id="preview"
                            src="https://placehold.co/180x180?text=No+Logo"
                            class="w-44 h-44 object-cover rounded-lg border shadow">

                    @endif

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                    Update Setting

                </button>

            </form>

        </div>

    </div>

    <script>
        const logo = document.getElementById('logo');
        const preview = document.getElementById('preview');

        logo.addEventListener('change', function(event) {

            const file = event.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
            }

        });
    </script>

</body>

</html>