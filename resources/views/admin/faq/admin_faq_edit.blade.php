<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto py-10">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-3xl font-bold mb-8">
            Edit FAQ
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.faq.update',$faq->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block font-semibold mb-2">Question</label>

                <input
                    type="text"
                    name="question"
                    value="{{ old('question',$faq->question) }}"
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">Answer</label>

                <textarea
                    name="answer"
                    rows="6"
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>{{ old('answer',$faq->answer) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">Sort Order</label>

                <input
                    type="number"
                    name="sort_order"
                    value="{{ old('sort_order',$faq->sort_order) }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <div class="flex gap-4">

                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                    Update FAQ
                </button>

                <a href="{{ route('admin.faq') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    Back
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html> 