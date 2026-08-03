<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Floating Button -->
<button id="rentalBtn"
    class="fixed bottom-32 right-6 w-16 h-16 rounded-full bg-blue-600 text-white text-3xl shadow-xl hover:bg-blue-700 z-50">
    🚗
</button>

<!-- Rental Window -->
<div id="rentalWindow"
    class="hidden fixed bottom-24 right-6 w-[400px] max-w-[95%] h-[650px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden z-50">

    <!-- Header -->
    <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h2 class="font-bold">🚗 {{ translate('Rental Price Estimation') }}</h2>

        <button id="closeRental" class="text-2xl">
            &times;
        </button>
    </div>

    <!-- Body -->
    <div class="flex-1 overflow-y-auto p-5">

        <div class="flex">

            <div
                class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                AI
            </div>

            <div class="ml-3 bg-gray-100 rounded-xl p-4 w-full">

                <p class="font-semibold mb-4">
                    {{ translate('Enter rental details to estimate the rental cost.') }}
                </p>

                <form id="rentalForm">

                    @csrf

                    <select name="rental_id"
                        class="w-full border rounded-lg p-3 mb-3"
                        required>

                        @foreach($rentals as $rental)

                            <option value="{{ $rental->id }}">
                                {{ translate($rental->car->title ?? 'Rental #'.$rental->id) }}
                            </option>

                        @endforeach

                    </select>

                    <label class="block mb-1 font-medium">
                        {{ translate('Pickup Date') }}
                    </label>

                    <input type="date"
                        name="pickup_date"
                        class="w-full border rounded-lg p-3 mb-3"
                        required>

                    <label class="block mb-1 font-medium">
                        {{ translate('Return Date') }}
                    </label>

                    <input type="date"
                        name="return_date"
                        class="w-full border rounded-lg p-3 mb-3"
                        required>

                    <input type="number"
                        name="insurance"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Insurance Charge') }}">

                    <input type="number"
                        name="extra_charge"
                        class="w-full border rounded-lg p-3 mb-3"
                        placeholder="{{ translate('Extra Charge') }}">

                    <button
                        class="w-full bg-blue-600 text-white py-3 rounded-lg">
                        {{ translate('Estimate Rental Price') }}
                    </button>

                </form>

                <div id="rentalResult"
                    class="hidden mt-5 bg-green-50 border border-green-200 rounded-lg p-4">
                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const rentalBtn = document.getElementById("rentalBtn");
    const rentalWindow = document.getElementById("rentalWindow");
    const closeRental = document.getElementById("closeRental");

    rentalBtn.onclick = () => {
        rentalWindow.classList.remove("hidden");
    }

    closeRental.onclick = () => {
        rentalWindow.classList.add("hidden");
    }

    const form = document.getElementById("rentalForm");
    const result = document.getElementById("rentalResult");

    form.addEventListener("submit", async function(e){

        e.preventDefault();

        result.classList.add("hidden");

        const formData = new FormData(form);

        const response = await fetch("{{ route('rental.estimation') }}",{

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
                Rental Estimate
            </h3>

            <p><strong>Total Days :</strong> ${data.days}</p>

            <p><strong>Price Per Day :</strong> $${data.price_per_day}</p>

            <p class="mt-2 text-xl font-bold text-green-700">
                Estimated Price : $${data.estimated_price}
            </p>
        `;

    });

});
</script>