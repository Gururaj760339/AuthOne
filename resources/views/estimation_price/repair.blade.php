<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Floating Button -->
<button id="repairBtn"
    class="fixed bottom-32 right-6 w-16 h-16 rounded-full bg-orange-600 text-white text-3xl shadow-xl hover:bg-orange-700 z-50">
    🔧
</button>

<!-- Repair Window -->
<div id="repairWindow"
    class="hidden fixed bottom-24 right-6 w-[400px] max-w-[95%] h-[650px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden z-50">

    <!-- Header -->
    <div class="bg-orange-600 text-white p-4 flex justify-between items-center">
        <h2 class="font-bold">🔧{{ translate('Repair Price Estimation') }}</h2>

        <button id="closeRepair" class="text-2xl">
            &times;
        </button>
    </div>

    <!-- Body -->
    <div class="flex-1 overflow-y-auto p-5">

        <div class="flex">

            <div
                class="w-10 h-10 rounded-full bg-orange-600 text-white flex items-center justify-center font-bold">
                {{ translate('AI') }}
            </div>

            <div class="ml-3 bg-gray-100 rounded-xl p-4 w-full">

                <p class="font-semibold mb-4">
                    {{ translate('Enter repair details to estimate the repair cost.') }}
                </p>

                <form id="repairForm">

                    @csrf

                    <select name="service_id"
                        class="w-full border rounded-lg p-3 mb-3" required>

                        @foreach($services as $service)

                            <option value="{{ $service->id }}">
                                {{ translate($service->title) }}
                            </option>

                        @endforeach

                    </select>

                    <input type="number"
                        name="parts_price"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Parts Price') }}"
                        required>

                    <input type="number"
                        name="labor_cost"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Labor Cost') }}"
                        required>

                    <input type="number"
                        name="location_charge"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Location Charge') }}">

                    <button
                        class="w-full bg-orange-600 text-white py-3 rounded-lg">
                        {{ translate('Estimate Price') }}
                    </button>

                </form>

                <div id="repairResult"
                    class="hidden mt-5 bg-green-50 border border-green-200 rounded-lg p-4">

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded",function(){

    const repairBtn=document.getElementById("repairBtn");
    const repairWindow=document.getElementById("repairWindow");
    const closeRepair=document.getElementById("closeRepair");

    repairBtn.onclick=()=>{

        repairWindow.classList.remove("hidden");

    }

    closeRepair.onclick=()=>{

        repairWindow.classList.add("hidden");

    }

    const form=document.getElementById("repairForm");
    const result=document.getElementById("repairResult");

    form.addEventListener("submit",async function(e){

        e.preventDefault();

        result.classList.add("hidden");

        const formData=new FormData(form);

        const response=await fetch("{{ route('repair.estimation') }}",{

            method:"POST",

            headers:{
                "Accept":"application/json",
                "X-CSRF-TOKEN":document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            },

            body:formData

        });

        const data=await response.json();

        result.classList.remove("hidden");

        result.innerHTML=`

            <h3 class="font-bold text-green-700 mb-3">
                Repair Estimate
            </h3>

            <p><strong>Service :</strong> ${data.service}</p>

            <p class="mt-2 text-xl font-bold text-green-700">
                Estimated Price :
                $${data.estimated_price}
            </p>

        `;

    });

});

</script>