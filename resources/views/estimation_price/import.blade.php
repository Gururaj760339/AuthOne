<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Floating Button -->
<button id="importBtn"
    class="fixed bottom-32 right-6 w-16 h-16 rounded-full bg-purple-600 text-white text-3xl shadow-xl hover:bg-purple-700 z-50">
    🚢
</button>

<!-- Import Window -->
<div id="importWindow"
    class="hidden fixed bottom-24 right-6 w-[400px] max-w-[95%] h-[650px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden z-50">

    <!-- Header -->
    <div class="bg-purple-600 text-white p-4 flex justify-between items-center">

        <h2 class="font-bold">
            🚢 {{ translate('Import Price Estimation') }}
        </h2>

        <button id="closeImport" class="text-2xl">
            &times;
        </button>

    </div>

    <!-- Body -->
    <div class="flex-1 overflow-y-auto p-5">

        <div class="flex">

            <div
                class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold">
                AI
            </div>

            <div class="ml-3 bg-gray-100 rounded-xl p-4 w-full">

                <p class="font-semibold mb-4">
                    {{ translate('Enter import details to estimate the total import cost.') }}
                </p>

                <form id="importForm">

                    @csrf

                    <input type="number"
                        name="car_price"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Car Price') }}"
                        required>

                    <input type="number"
                        name="shipping_cost"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Shipping Cost') }}"
                        required>

                    <input type="number"
                        name="customs_duty"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Customs Duty') }}"
                        required>

                    <input type="number"
                        name="vat"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('VAT') }}"
                        required>

                    <input type="number"
                        name="registration_fee"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Registration Fee') }}"
                        required>

                    <button
                        class="w-full bg-purple-600 text-white py-3 rounded-lg">
                        {{ translate('Estimate Import Cost') }}
                    </button>

                </form>

                <div id="importResult"
                    class="hidden mt-5 bg-green-50 border border-green-200 rounded-lg p-4">
                </div>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const importBtn = document.getElementById("importBtn");
    const importWindow = document.getElementById("importWindow");
    const closeImport = document.getElementById("closeImport");

    importBtn.onclick = () => {
        importWindow.classList.remove("hidden");
    }

    closeImport.onclick = () => {
        importWindow.classList.add("hidden");
    }

    const form = document.getElementById("importForm");
    const result = document.getElementById("importResult");

    form.addEventListener("submit", async function(e){

        e.preventDefault();

        result.classList.add("hidden");

        const formData = new FormData(form);

        const response = await fetch("{{ route('import.estimation') }}",{

            method:"POST",

            headers:{
                "Accept":"application/json",
                "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content
            },

            body:formData

        });

        const data = await response.json();

        result.classList.remove("hidden");

        result.innerHTML = `

            <h3 class="font-bold text-green-700 mb-3">
                Import Estimate
            </h3>

            <p class="text-xl font-bold text-green-700">
                Estimated Import Cost :
                $${data.estimated_price}
            </p>

        `;

    });

});

</script>