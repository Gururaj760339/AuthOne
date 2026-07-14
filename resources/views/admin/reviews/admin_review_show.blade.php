<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10">

    <div class="bg-white shadow rounded-lg">

        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold">
                Customer Reviews
            </h2>
        </div>

        @if(session('success'))
            <div class="m-5 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-200">

                <tr>

                    <th class="p-3 text-left">ID</th>

                    <th class="p-3 text-left">Image</th>

                    <th class="p-3 text-left">Name</th>

                    <th class="p-3 text-left">Location</th>

                    <th class="p-3 text-left">Rating</th>

                    <th class="p-3 text-left">Review</th>

                    <th class="p-3 text-center">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($reviews as $review)

                    <tr class="border-b">

                        <td class="p-3">
                            {{ $review->id }}
                        </td>

                        <td class="p-3">

                            @if($review->image)
                                <img src="{{ 'storage/'.$review->image }}"
                                     class="w-20 h-20 rounded object-cover">
                            @else
                                No Image
                            @endif

                        </td>

                        <td class="p-3">
                            {{ $review->name }}
                        </td>

                        <td class="p-3">
                            {{ $review->location }}
                        </td>

                        <td class="p-3">
                            ⭐ {{ $review->rating }}/5
                        </td>

                        <td class="p-3">
                            {{ $review->review }}
                        </td>

                        <td class="p-3 text-center">

                            <form action="{{ route('admin.destroy',$review->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this review?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center py-6">
                            No Reviews Found
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>