<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nearby Roadside Providers</title>

    
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50 min-h-screen">

    {{-- Header --}}
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                        Nearby Roadside Assistance
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Find verified roadside providers near your location
                    </p>
                </div>

                <a href="{{ url('/') }}"
                    class="inline-flex items-center justify-center px-5 py-2.5
                          bg-gray-900 hover:bg-gray-800 text-white
                          text-sm font-semibold rounded-lg transition">

                    Back to Home
                </a>

            </div>

        </div>
    </header>


    {{-- Main --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Location Info --}}
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-xl p-4">

            <div class="flex items-start gap-3">

                <div
                    class="w-10 h-10 rounded-full bg-blue-100
                            flex items-center justify-center flex-shrink-0">

                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 21a2 2 0 01-2.828 0l-4.243-4.343a8 8 0 1111.314 0z" />

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                    </svg>

                </div>

                <div>
                    <h3 class="font-semibold text-blue-900">
                        Providers near you
                    </h3>

                    <p class="text-sm text-blue-700 mt-1">
                        Showing the nearest available and verified roadside providers.
                    </p>
                </div>

            </div>

        </div>


        {{-- Provider List --}}
        @if (isset($providers) && $providers->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($providers as $provider)
                    <div
                        class="bg-white rounded-2xl border border-gray-200
                                shadow-sm hover:shadow-xl transition duration-300
                                overflow-hidden">

                        {{-- Top --}}
                        <div class="p-6">

                            <div class="flex items-start justify-between">

                                <div class="flex items-center gap-4">

                                    {{-- Avatar --}}
                                    <div
                                        class="w-14 h-14 rounded-full
                                                bg-blue-100 overflow-hidden
                                                flex items-center justify-center">

                                        @if (!empty($provider->profile_picture))
                                            <img src="{{ asset('storage/' . $provider->profile_picture) }}"
                                                alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xl font-bold text-blue-600">
                                                {{ strtoupper(substr($provider->name ?? 'P', 0, 1)) }}
                                            </span>
                                        @endif

                                    </div>


                                    {{-- Name --}}
                                    <div>

                                        <h2 class="text-lg font-bold text-gray-900">
                                            {{ $provider->name }}
                                        </h2>

                                        <div class="flex items-center gap-1 mt-1">

                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">

                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l3-3z"
                                                    clip-rule="evenodd" />

                                            </svg>

                                            <span class="text-xs font-medium text-green-600">
                                                Verified
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- Availability --}}
                                <span
                                    class="px-2.5 py-1 rounded-full
                                             bg-green-100 text-green-700
                                             text-xs font-semibold">

                                    Available

                                </span>

                            </div>


                            {{-- Distance --}}
                            <div class="mt-6 p-4 bg-gray-50 rounded-xl">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-10 h-10 rounded-lg bg-blue-100
                                                    flex items-center justify-center">

                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />

                                                <circle cx="12" cy="9" r="2.5" stroke-width="2" />

                                            </svg>

                                        </div>

                                        <div>

                                            <p class="text-xs text-gray-500">
                                                Distance
                                            </p>

                                            <p class="text-lg font-bold text-gray-900">

                                                {{ number_format($provider->distance, 2) }}

                                                <span class="text-sm font-medium text-gray-500">
                                                    km
                                                </span>

                                            </p>

                                        </div>

                                    </div>

                                    <span class="text-xs text-gray-500">
                                        Nearby
                                    </span>

                                </div>

                            </div>


                            {{-- Phone --}}
                            @if (!empty($provider->phone))
                                <div class="mt-4 flex items-center gap-3">

                                    <div
                                        class="w-9 h-9 rounded-lg bg-gray-100
                                                flex items-center justify-center">

                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a2 2 0 011.94 1.515l.7 2.805a2 2 0 01-.45 1.83L9.12 10.5a16 16 0 006.38 6.38l1.35-1.35a2 2 0 011.83-.45l2.805.7A2 2 0 0123 17.72V21a2 2 0 01-2 2h-1C10.611 23 1 13.389 1 2V1a2 2 0 012-2z" />

                                        </svg>

                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-500">
                                            Phone
                                        </p>

                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $provider->phone }}
                                        </p>
                                    </div>

                                </div>
                            @endif


                            {{-- Address --}}
                            @if (!empty($provider->address))
                                <div class="mt-4 flex items-start gap-3">

                                    <div
                                        class="w-9 h-9 rounded-lg bg-gray-100
                                                flex items-center justify-center flex-shrink-0">

                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 21a2 2 0 01-2.828 0l-4.243-4.343a8 8 0 1111.314 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Location
                                        </p>

                                        <p class="text-sm text-gray-700">
                                            {{ $provider->address }}
                                        </p>

                                    </div>

                                </div>
                            @endif


                            {{-- Buttons --}}
                            <div class="mt-6 grid grid-cols-2 gap-3">

                                <a href="{{ route('customer.roadside.request.create', $provider->id) }}"
                                    class="flex items-center justify-center
                                          px-4 py-3 rounded-xl
                                          bg-blue-600 hover:bg-blue-700
                                          text-white text-sm font-semibold
                                          transition">

                                    Request Service

                                </a>


                                @if (!empty($provider->phone))
                                    <a href="tel:{{ $provider->phone }}"
                                        class="flex items-center justify-center
                                              px-4 py-3 rounded-xl
                                              border border-gray-300
                                              hover:bg-gray-50
                                              text-gray-700 text-sm font-semibold
                                              transition">

                                        Call Provider

                                    </a>
                                @else
                                    <button disabled
                                        class="px-4 py-3 rounded-xl
                                                   bg-gray-100 text-gray-400
                                                   text-sm font-semibold">

                                        No Phone

                                    </button>
                                @endif

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            {{-- No Providers --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        p-10 md:p-16 text-center">

                <div
                    class="mx-auto w-20 h-20 rounded-full
                            bg-gray-100 flex items-center justify-center">

                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                    </svg>

                </div>

                <h2 class="mt-5 text-2xl font-bold text-gray-900">
                    No Roadside Providers Found
                </h2>

                <p class="mt-2 text-gray-500 max-w-md mx-auto">
                    There are currently no verified and available roadside
                    assistance providers near your location.
                </p>

                <a href="{{ url('/') }}"
                    class="inline-flex mt-6 px-6 py-3
                          bg-blue-600 hover:bg-blue-700
                          text-white font-semibold rounded-xl transition">

                    Back to Home

                </a>

            </div>

        @endif

    </main>


    {{-- Footer --}}
    <footer class="border-t border-gray-200 bg-white mt-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <p class="text-center text-sm text-gray-500">
                © {{ date('Y') }} AutoOne. All rights reserved.
            </p>

        </div>

    </footer>

</body>

</html>
