<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Find Nearby Roadside Assistance</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

    <div class="max-w-xl mx-auto px-4 py-16">

        <div class="bg-white rounded-2xl shadow-sm border p-8 text-center">

            <div
                class="w-20 h-20 mx-auto rounded-full
                        bg-red-100 flex items-center
                        justify-center text-4xl">

                📍

            </div>

            <h1 class="text-2xl font-bold text-slate-900 mt-6">
                Find Nearby Roadside Assistance
            </h1>

            <p class="text-slate-500 mt-3">
                We need your current location to find
                the nearest available roadside partners.
            </p>


            {{-- Error --}}

            <div id="error"
                class="hidden mt-5 bg-red-50
                        border border-red-200
                        text-red-600
                        rounded-xl px-4 py-3 text-sm">
            </div>


            {{-- Loading --}}

            <div id="loading" class="hidden mt-6">

                <div
                    class="animate-spin rounded-full
                            h-10 w-10
                            border-4 border-slate-200
                            border-t-red-600
                            mx-auto">
                </div>

                <p class="text-slate-500 mt-3">
                    Finding nearby partners...
                </p>

            </div>


            {{-- Location Button --}}

            <button type="button" id="locationButton" onclick="getLocation()"
                class="w-full mt-8
                       bg-red-600
                       hover:bg-red-700
                       text-white
                       rounded-xl
                       px-6 py-4
                       font-bold
                       transition">

                📍 Use My Current Location

            </button>


            {{-- Manual coordinates form --}}

            <form id="locationForm"
                action="{{ route('customer.roadside.providers') }}" method="GET"
                class="hidden">

                <input type="hidden" name="latitude" id="latitude">

                <input type="hidden" name="longitude" id="longitude">

            </form>

        </div>

    </div>


    <script>
        function getLocation() {
            const button = document.getElementById('locationButton');
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');

            // Clear previous error
            error.classList.add('hidden');
            error.innerHTML = '';

            // Browser support check
            if (!navigator.geolocation) {

                showError(
                    'Your browser does not support location services.'
                );

                return;
            }

            // Button state
            button.disabled = true;
            button.classList.add('opacity-50');
            button.innerHTML = 'Getting Location...';

            loading.classList.remove('hidden');


            navigator.geolocation.getCurrentPosition(

                function(position) {

                    const latitude =
                        position.coords.latitude;

                    const longitude =
                        position.coords.longitude;


                    /*
                    |--------------------------------------------------------------------------
                    | Put coordinates into hidden inputs
                    |--------------------------------------------------------------------------
                    */

                    document.getElementById('latitude').value =
                        latitude;

                    document.getElementById('longitude').value =
                        longitude;


                    /*
                    |--------------------------------------------------------------------------
                    | Submit to showProvider()
                    |--------------------------------------------------------------------------
                    */

                    document.getElementById('locationForm').submit();

                },

                function(error) {

                    loading.classList.add('hidden');

                    button.disabled = false;
                    button.classList.remove('opacity-50');

                    button.innerHTML =
                        '📍 Try Again';


                    let message =
                        'Unable to get your location.';


                    switch (error.code) {

                        case error.PERMISSION_DENIED:

                            message =
                                'Location permission was denied. Please allow location access in your browser.';

                            break;


                        case error.POSITION_UNAVAILABLE:

                            message =
                                'Your location is currently unavailable. Please try again.';

                            break;


                        case error.TIMEOUT:

                            message =
                                'Location request timed out. Please try again.';

                            break;

                    }


                    showError(message);

                },

                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }

            );
        }


        function showError(message) {
            const error =
                document.getElementById('error');

            error.innerHTML = message;

            error.classList.remove('hidden');
        }
    </script>

</body>

</html>
