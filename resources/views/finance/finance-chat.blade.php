<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Floating Button -->
<button id="chatBtn"
    class="fixed bottom-32 right-6 w-16 h-16 rounded-full bg-blue-600 text-white text-3xl shadow-xl hover:bg-blue-700 z-50">
    💬
</button>

<!-- Chat Window -->
<div id="chatWindows"
    class="hidden fixed bottom-24 right-6 w-[400px] max-w-[95%] h-[650px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden z-50">

    <!-- Header -->
    <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h2 class="font-bold">🤖 {{ translate('AutoOne AI Assistant') }}</h2>

        <button id="closeChats" class="text-2xl">&times;</button>
    </div>

    <!-- Messages -->
    <div class="flex-1 overflow-y-auto p-5">

        <div class="flex">

            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                AI
            </div>

            <div class="ml-3 bg-gray-100 rounded-xl p-4 w-full">

                <p class="font-semibold mb-4">
                    👋 {{ translate('Hello! I can calculate your monthly finance payment.') }}
                </p>

                <form id="financeForm">

                    <input type="number" name="car_price" class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Car Price') }}" required>

                    <input type="number" name="down_payment" class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Down Payment') }}" required>

                    <input type="number" step="0.01" name="interest_rate" class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Interest Rate (%)') }}" required>

                    <input type="number" name="months" class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Loan Duration (Months)') }}" required>

                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg">
                        {{ translate('Calculate EMI') }}
                    </button>

                </form>

                <div id="result" class="hidden mt-5 bg-green-50 border border-green-200 rounded-lg p-4">
                </div>

            </div>

        </div>

    </div>

</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const chatBtn = document.getElementById("chatBtn");
        const chatWindow = document.getElementById("chatWindows");
        const closeBtn = document.getElementById("closeChats");

        chatBtn.onclick = () => {
            chatWindow.classList.remove("hidden");
        }

        closeBtn.onclick = () => {
            chatWindow.classList.add("hidden");
        }

        const form = document.getElementById("financeForm");
        const result = document.getElementById("result");

        form.addEventListener("submit", async function(e) {

            e.preventDefault();

            result.classList.add("hidden");

            const formData = new FormData(form);

            try {

                const response = await fetch("/api/finance-calculator", {

                    method: "POST",
                    headers: {
                        "Accept": "application/json"
                    },

                    body: formData

                });

                const data = await response.json();
                console.log(data);

                if (data.success) {

                    result.classList.remove("hidden");

                    result.innerHTML = `
                    <h3 class="font-bold text-green-700 mb-3">
                        Finance Calculation Complete
                    </h3>

        <p><strong>Loan Amount :</strong> ${data.data.loan_amount}</p>

        <p><strong>Monthly EMI :</strong> ${data.data.monthly_emi}</p>

        <p><strong>Total Interest :</strong> ${data.data.total_interest}</p>

        <p><strong>Total Payment :</strong> ${data.data.total_payment}</p>

        <a href="{{ route('customer.finance.apply') }}"
           class="block mt-4 bg-green-600 text-center text-white py-2 rounded-lg">
            Apply For Finance
        </a>
    `;

                } else {

                    alert("Calculation Failed");

                }

            } catch (error) {

                console.log(error);

                alert("Server Error");

            }

        });

    });
</script>
