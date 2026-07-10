<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.book_rental_car') }} | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center py-12 px-4">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">

        @include('language_drop_down')


        <h2 class="text-3xl font-bold text-center text-slate-800 mb-2">
            {{ __('messages.book_rental_car') }}
        </h2>


        <p class="text-center text-gray-500 mb-8">
            {{ __('messages.book_rental_car_desc') }}
        </p>


        <form action="#" method="POST" class="space-y-6">

            @csrf


            <!-- Select Rental Car -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.select_rental_car') }}
                </label>


                <select 
                    name="rental_id"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>


                    <option value="">
                        {{ __('messages.choose_rental_car') }}
                    </option>


                    <option value="1">
                        Toyota Corolla - $50/day
                    </option>


                    <option value="2">
                        Honda Civic - $60/day
                    </option>


                    <option value="3">
                        BMW X5 - $150/day
                    </option>


                    <option value="4">
                        Mercedes C-Class - $120/day
                    </option>


                    <option value="5">
                        Hyundai Tucson - $80/day
                    </option>


                </select>

            </div>



            <!-- Pickup Date -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.pickup_date') }}
                </label>


                <input
                    type="date"
                    name="pickup_date"
                    min="{{ date('Y-m-d') }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

            </div>



            <!-- Return Date -->
            <div>

                <label class="block font-semibold mb-2">
                    {{ __('messages.return_date') }}
                </label>


                <input
                    type="date"
                    name="return_date"
                    min="{{ date('Y-m-d') }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                    required>

            </div>



            <!-- Terms -->
            <div class="flex items-center gap-2">

                <input 
                    type="checkbox"
                    required>


                <span class="text-sm text-gray-600">
                    {{ __('messages.rental_terms') }}
                </span>

            </div>




            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">


                {{ __('messages.confirm_rental_booking') }}


            </button>


        </form>


    </div>

</div>


</body>

</html>