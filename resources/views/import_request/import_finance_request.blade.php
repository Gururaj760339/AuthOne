<!DOCTYPE html>
<html>

<head>

    <title>Import Finance Request</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-8">

        <h2 class="text-3xl font-bold text-center mb-8">

            Import Finance Request

        </h2>

        <form action="{{ route('customer.import.finance.store') }}" method="POST">

            @csrf

            <input
                type="hidden"
                name="import_request_id"
                value="{{ $importRequest->id }}">

            <div class="mb-4">

                <label class="font-semibold">

                    Finance Partner

                </label>

                <select
                    name="finance_partner_id"
                    class="w-full border rounded-lg p-3"
                    required>

                    <option value="">

                        Select Finance Partner

                    </option>

                    @foreach($financePartners as $partner)

                        <option value="{{ $partner->id }}">

                            {{ $partner->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label>

                    Car Price

                </label>

                <input
                    type="text"
                    name="car_price"
                    readonly
                    value="{{ number_format($car->price,2) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-4">

                <label>

                    Down Payment

                </label>

                <input
                    name="down_payment"
                    type="text"
                    readonly
                    value="{{ number_format($importRequest->budget,2) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-4">

                <label>

                    Loan Amount

                </label>

                <input
                    type="text"
                    readonly
                    value="{{ number_format($loanAmount,2) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-4">

                <label>

                    Loan Duration

                </label>

                <select
                    name="loan_duration"
                    class="w-full border rounded-lg p-3">

                    <option value="12">12 Months</option>
                    <option value="24">24 Months</option>
                    <option value="36">36 Months</option>
                    <option value="48">48 Months</option>
                    <option value="60">60 Months</option>

                </select>

            </div>

            <div class="mb-5">

                <label>

                    Remarks

                </label>

                <textarea
                    name="remarks"
                    rows="4"
                    class="w-full border rounded-lg p-3"></textarea>

            </div>

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg">

                Submit Finance Request

            </button>

        </form>

    </div>

</body>

</html>