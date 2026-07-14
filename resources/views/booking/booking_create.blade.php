<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.book_maintenance') }} | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center py-12 px-4">

        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">

            @include('language_drop_down')

            <h1 class="text-3xl font-bold text-center text-slate-800 mb-2">
                {{ __('messages.book_maintenance') }}
            </h1>

            <p class="text-center text-gray-500 mb-8">
                {{ __('messages.book_maintenance_desc') }}
            </p>

            <form action="{{ route('customer.booking.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Service -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.select_service') }}
                    </label>

                    <select name="service_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->title }}
                            </option>
                        @endforeach

{{-- 
                        <option value="1">{{ __('messages.oil_change') }}</option>
                        <option value="2">{{ __('messages.brake_service') }}</option>
                        <option value="3">{{ __('messages.engine_diagnostics') }}</option>
                        <option value="4">{{ __('messages.ac_repair') }}</option>
                        <option value="5">{{ __('messages.battery_replacement') }}</option>
                        <option value="6">{{ __('messages.tire_replacement') }}</option>
                        <option value="7">{{ __('messages.wheel_alignment') }}</option>
                        <option value="8">{{ __('messages.engine_repair') }}</option> --}}

                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.booking_date') }}
                    </label>

                    <input type="date" name="booking_date"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Time -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.preferred_time') }}
                    </label>

                    <input type="time" name="booking_time"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('messages.additional_notes') }}
                    </label>

                    <textarea name="notes" rows="5" placeholder="{{ __('messages.notes_placeholder') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
                    {{ __('messages.confirm_booking') }}
                </button>

            </form>

        </div>

    </div>

</body>

</html>
