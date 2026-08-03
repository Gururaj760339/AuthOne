<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ translate('AI Chatbot') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Floating Button -->
    <button id="chatToggle"
        class="fixed bottom-6 right-6 w-16 h-16 rounded-full bg-blue-600 hover:bg-blue-700 shadow-2xl flex items-center justify-center text-white transition duration-300 z-50">

        <!-- Chat Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h8M8 14h5M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.2-4A7.77 7.77 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />

        </svg>

    </button>

    <!-- Chat Window -->

    <div id="chatWindow"
        class="hidden fixed bottom-24 right-6 w-[380px] h-[560px] bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col z-50">

        <!-- Header -->

        <div class="bg-blue-600 text-white p-4 flex justify-between items-center">

            <div>

                <h2 class="font-bold text-lg">
                    {{ translate('AI Assistant') }}
                </h2>

                <p class="text-xs opacity-80">
                    {{ translate('Ask me anything') }}
                </p>

            </div>

            <button id="closeChat" class="text-2xl">&times;</button>

        </div>

        <!-- Messages -->

        <div id="messages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50">

            <div class="bg-blue-100 p-3 rounded-xl w-fit max-w-xs">
                👋 {{ translate('Hello! How can I help you?') }}
            </div>

        </div>

        <!-- Input -->

        <div class="border-t p-3 bg-white">

            <div class="flex gap-2">

                <input id="message" type="text" placeholder="Type your message..."
                    class="flex-1 border rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">

                <button onclick="sendMessage()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-xl">

                    {{ translate('Send') }}

                </button>

            </div>

        </div>

    </div>

    <script>
        const chatToggle = document.getElementById("chatToggle");
        const chatWindow = document.getElementById("chatWindow");
        const closeChat = document.getElementById("closeChat");

        chatToggle.addEventListener("click", () => {

            chatWindow.classList.toggle("hidden");

        });

        closeChat.addEventListener("click", () => {

            chatWindow.classList.add("hidden");

        });

        document.getElementById("message").addEventListener("keypress", function(e) {

            if (e.key === "Enter") {
                sendMessage();
            }

        });

        async function sendMessage() {

            const input = document.getElementById("message");
            const message = input.value.trim();

            if (!message) return;

            const chat = document.getElementById("messages");

            chat.innerHTML += `
        <div class="flex justify-end">
            <div class="bg-blue-600 text-white p-3 rounded-xl max-w-xs">
                ${message}
            </div>
        </div>
    `;

            input.value = "";

            chat.scrollTop = chat.scrollHeight;

            try {

                const response = await fetch('/chatbot', {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content

                    },

                    body: JSON.stringify({

                        message: message

                    })

                });

                const text = await response.text();

                if (!response.ok) {

                    chat.innerHTML += `
                <div class="flex">
                    <div class="bg-red-100 text-red-600 p-3 rounded-xl max-w-xs">
                        Server Error (${response.status})
                    </div>
                </div>
            `;

                    return;

                }

                const data = JSON.parse(text);

                chat.innerHTML += `
            <div class="flex">
                <div class="bg-gray-200 p-3 rounded-xl max-w-xs">
                    ${data.reply}
                </div>
            </div>
        `;

                chat.scrollTop = chat.scrollHeight;

            } catch (error) {

                chat.innerHTML += `
            <div class="flex">
                <div class="bg-red-100 text-red-600 p-3 rounded-xl max-w-xs">
                    Something went wrong.
                </div>
            </div>
        `;

            }

        }
    </script>

</body>

</html>
