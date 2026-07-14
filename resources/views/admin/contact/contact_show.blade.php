<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">
            Contact Messages
        </h1>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-800 text-white">

                <tr>

                    <th class="px-4 py-3">ID</th>

                    <th class="px-4 py-3">Name</th>

                    <th class="px-4 py-3">Email</th>

                    <th class="px-4 py-3">Phone</th>

                    <th class="px-4 py-3">Subject</th>

                    <th class="px-4 py-3">Message</th>

                    <th class="px-4 py-3">Date</th>

                    <th class="px-4 py-3">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($contacts as $contact)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-3">{{ $contact->id }}</td>

                    <td class="px-4 py-3">{{ $contact->name }}</td>

                    <td class="px-4 py-3">{{ $contact->email }}</td>

                    <td class="px-4 py-3">{{ $contact->phone }}</td>

                    <td class="px-4 py-3">{{ $contact->subject }}</td>

                    <td class="px-4 py-3">
                        {{ Str::limit($contact->message, 80) }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $contact->created_at->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3">

                        <form action="{{ route('admin.contact.destroy',$contact->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this message?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center py-10">

                        No Contact Messages Found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>