<!DOCTYPE html>
<html>

<head>
    <title>Warranty Plans</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h2>Warranty Plans</h2>

        <a href="{{ route('admin.warranty.plans.create') }}" class="btn btn-primary mb-3">
            Add Warranty Plan
        </a>

        <table class="table table-bordered">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>KM</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($plans as $plan)
                    <tr>

                        <td>{{ $plan->id }}</td>

                        <td>{{ $plan->name }}</td>

                        <td>{{ $plan->duration_months }} Months</td>

                        <td>${{ number_format($plan->price, 2) }}</td>

                        <td>{{ number_format($plan->max_km) }} KM</td>

                        <td>
                            @if ($plan->status == 'Active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <td>

                            <form action="{{ route('admin.warranty.plans.destroy', $plan->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this warranty plan?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</body>

</html>
