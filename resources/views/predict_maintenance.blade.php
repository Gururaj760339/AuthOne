<!DOCTYPE html>
<html>

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Predictive Maintenance</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <!-- Floating Button -->
    <button id="predictToggle"
        class="fixed bottom-60 right-6 w-16 h-16 rounded-full bg-green-600 hover:bg-green-700 shadow-2xl flex items-center justify-center text-white transition duration-300 z-50">

        <!-- Wrench Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M14.7 6.3a4 4 0 01-5.66 5.66L3 18v3h3l6.04-6.04a4 4 0 005.66-5.66l-3 3-3-3 3-3z" />

        </svg>

    </button>

    <!-- Predictive Maintenance Window -->
    <div id="predictWindow"
        class="hidden fixed bottom-24 right-6 w-[420px] h-[650px] bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col z-50">

        <!-- Header -->
        <div class="bg-green-600 text-white p-4 flex justify-between items-center">

            <div>
                <h2 class="font-bold text-lg">
                    Predictive Maintenance
                </h2>

                <p class="text-xs opacity-80">
                    Check Vehicle Health
                </p>
            </div>

            <button id="closePredict" class="text-2xl">&times;</button>

        </div>

        <!-- Body -->
        <div class="flex-1 overflow-y-auto p-4 bg-gray-50">

            <div class="grid grid-cols-2 gap-3">

                <input id="engine_temp" type="number" placeholder="Engine Temp" class="border p-2 rounded">

                <input id="rpm" type="number" placeholder="RPM" class="border p-2 rounded">

                <input id="battery" type="number" placeholder="Battery Voltage" class="border p-2 rounded">

                <input id="fuel" type="number" placeholder="Fuel %" class="border p-2 rounded">

                <input id="oil" type="number" placeholder="Oil Life %" class="border p-2 rounded">

                <input id="mileage" type="number" placeholder="Mileage" class="border p-2 rounded">

                <select id="check_engine" class="border p-2 rounded col-span-2">

                    <option>OFF</option>
                    <option>ON</option>

                </select>

            </div>

            <button onclick="predict()" class="w-full bg-green-600 text-white py-2 rounded mt-4">

                Predict

            </button>

            <div id="result" class="mt-5"></div>

        </div>

    </div>

    <script>
        const predictToggle = document.getElementById("predictToggle");
        const predictWindow = document.getElementById("predictWindow");
        const closePredict = document.getElementById("closePredict");

        predictToggle.addEventListener("click", () => {
            predictWindow.classList.toggle("hidden");
        });

        closePredict.addEventListener("click", () => {
            predictWindow.classList.add("hidden");
        });

        function predict() {

            fetch('/api/predictive-maintenance', {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },

                    body: JSON.stringify({

                        engine_temp: document.getElementById('engine_temp').value,
                        rpm: document.getElementById('rpm').value,
                        battery: document.getElementById('battery').value,
                        fuel: document.getElementById('fuel').value,
                        oil: document.getElementById('oil').value,
                        mileage: document.getElementById('mileage').value,
                        check_engine: document.getElementById('check_engine').value

                    })

                })
                .then(res => res.json())
                .then(data => {

                    let html = `
        <div class="border rounded-xl p-4 bg-white">
            <h3 class="text-xl font-bold">
                Health Score : ${data.health_score}
            </h3>

            <p class="mt-2">
                Status : <b>${data.status}</b>
            </p>

            <p class="mt-2">
                ${data.recommendation}
            </p>

            <h4 class="font-bold mt-4">
                Problems
            </h4>

            <ul class="list-disc ml-5">
        `;

                    if (Array.isArray(data.problems)) {
                        data.problems.forEach(item => {
                            html += `<li>${item}</li>`;
                        });
                    } else {
                        html += `<li>No problems found.</li>`;
                    }

                    document.getElementById("result").innerHTML = html;


                });

        }
    </script>

</body>

</html>
