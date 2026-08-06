<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AI Total Cost Calculator</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Floating Calculator Button -->
    <button id="calculatorToggle"
        class="fixed bottom-6 right-6 w-16 h-16 rounded-full bg-green-600 hover:bg-green-700 shadow-2xl flex items-center justify-center text-white z-50">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 2h6a2 2 0 012 2v16a2 2 0 01-2 2H9a2 2 0 01-2-2V4a2 2 0 012-2zm2 4h2m-4 4h6m-6 4h2m2 0h2" />

        </svg>

    </button>

    <!-- Calculator Window -->
    <div id="calculatorWindow"
        class="hidden fixed bottom-24 right-6 w-[430px] max-h-[90vh] bg-white rounded-2xl shadow-2xl overflow-y-auto z-50">

        <!-- Header -->
        <div class="bg-green-600 text-white p-4 flex justify-between items-center">

            <div>

                <h2 class="font-bold text-lg">
                    AI Total Cost Calculator
                </h2>

                <p class="text-xs">
                    Estimate Import Cost
                </p>

            </div>

            <button id="closeCalculator" class="text-2xl">

                &times;

            </button>

        </div>

        <!-- Body -->
        <div class="p-5">

            <div class="grid grid-cols-2 gap-3">

                <input id="purchase" type="number" placeholder="Purchase Price" class="border rounded-lg p-2">

                <input id="shipping" type="number" placeholder="Shipping Cost" class="border rounded-lg p-2">

                <input id="insurance" type="number" placeholder="Insurance" class="border rounded-lg p-2">

                <input id="customs" type="number" value="5" placeholder="Customs %"
                    class="border rounded-lg p-2">

                <input id="vat" type="number" value="15" placeholder="VAT %" class="border rounded-lg p-2">

                <input id="other" type="number" placeholder="Other Fees" class="border rounded-lg p-2">

            </div>

            <button onclick="calculate()"
                class="w-full mt-5 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg">

                Calculate Cost

            </button>

            <div id="result" class="hidden mt-6">

            </div>

        </div>

    </div>

    <script>
        const calculatorToggle = document.getElementById('calculatorToggle');

        const calculatorWindow = document.getElementById('calculatorWindow');

        const closeCalculator = document.getElementById('closeCalculator');

        calculatorToggle.addEventListener('click', () => {

            calculatorWindow.classList.toggle('hidden');

        });

        closeCalculator.addEventListener('click', () => {

            calculatorWindow.classList.add('hidden');

        });

        function calculate() {

            fetch("{{ route('ai.total.cost.calculate') }}", {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },

                    body: JSON.stringify({

                        purchase_price: document.getElementById('purchase').value,

                        shipping_cost: document.getElementById('shipping').value,

                        insurance_cost: document.getElementById('insurance').value,

                        customs_rate: document.getElementById('customs').value,

                        vat_rate: document.getElementById('vat').value,

                        other_fees: document.getElementById('other').value

                    })

                })

                .then(response => response.json())

                .then(data => {

                    document.getElementById('result').classList.remove('hidden');

                    document.getElementById('result').innerHTML = `

                    <div class="bg-green-50 rounded-xl p-4 border">

                        <h3 class="text-lg font-bold mb-3">
                            Estimated Cost
                        </h3>

                        <table class="w-full text-sm">

                            <tr><td>Purchase</td><td class="text-right">$${data.purchase_price}</td></tr>

                            <tr><td>Shipping</td><td class="text-right">$${data.shipping_cost}</td></tr>

                            <tr><td>Insurance</td><td class="text-right">$${data.insurance_cost}</td></tr>

                            <tr><td>CIF</td><td class="text-right">$${data.cif}</td></tr>

                            <tr><td>Customs</td><td class="text-right">$${data.customs}</td></tr>

                            <tr><td>VAT</td><td class="text-right">$${data.vat}</td></tr>

                            <tr><td>Other Fees</td><td class="text-right">$${data.other_fees}</td></tr>

                            <tr class="font-bold text-green-700 border-t">

                            <td>Total Cost</td>

                                <td class="text-right">$${data.total}</td>

                            </tr>

                        </table>

                        <div class="mt-4">

                            <h4 class="font-semibold mb-2">
                                AI Recommendation
                            </h4>

                            <ul class="list-disc ml-5 text-sm">

                                ${data.recommendations.map(item=>`<li>${item}</li>`).join('')}

                            </ul>

                        </div>

                        </div>

                        `;

                })

                .catch(() => {

                    document.getElementById('result').classList.remove('hidden');

                    document.getElementById('result').innerHTML = `

                <div class="bg-red-100 text-red-600 p-4 rounded-lg">

                    Something went wrong.

                </div>

`;

                });

        }
    </script>

</body>

</html>
