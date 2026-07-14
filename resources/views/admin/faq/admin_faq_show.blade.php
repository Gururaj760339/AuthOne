<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQ</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">
            Manage FAQ
        </h1>

        <a href="{{ route('admin.faq.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
            + Add FAQ
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-800 text-white">

                <tr>

                    <th class="p-4 text-left">ID</th>

                    <th class="p-4 text-left">Question</th>

                    <th class="p-4 text-left">Answer</th>

                    <th class="p-4 text-center">Sort</th>

                    <th class="p-4 text-center">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($faqs as $faq)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4">
                        {{ $faq->id }}
                    </td>

                    <td class="p-4 font-semibold">
                        {{ $faq->question }}
                    </td>

                    <td class="p-4">
                        {{ Str::limit($faq->answer,80) }}
                    </td>

                    <td class="p-4 text-center">
                        {{ $faq->sort_order }}
                    </td>

                    <td class="p-4">

                        <div class="flex justify-center gap-3">

                            <a href="{{ route('admin.faq.edit',$faq->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.faq.destroy',$faq->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this FAQ?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-10">

                        No FAQ Found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>