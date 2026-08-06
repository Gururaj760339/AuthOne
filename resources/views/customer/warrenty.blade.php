<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Car Warranties</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <h2 class="mb-4">My Car Warranties</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($warranties->count())

        <div class="table-responsive">

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Car</th>
                        <th>Warranty Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration</th>
                        <th>Coverage</th>
                        <th>Status</th>
                        <th>Remaining</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($warranties as $index => $warranty)

                    @php
                        $daysLeft = now()->diffInDays($warranty->end_date, false);
                    @endphp

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $warranty->car->title ?? '' }}
                        </td>

                        <td>
                            @if($warranty->type == 'Manufacturer')
                                <span class="badge bg-primary">Manufacturer</span>
                            @else
                                <span class="badge bg-warning text-dark">Extended</span>
                            @endif
                        </td>

                        <td>{{ \Carbon\Carbon::parse($warranty->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($warranty->end_date)->format('d M Y') }}</td>

                        <td>{{ $warranty->duration_months }} Months</td>

                        <td>{{ number_format($warranty->max_km) }} KM</td>

                        <td>
                            @if($warranty->status == 'Active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Expired</span>
                            @endif
                        </td>

                        <td>
                            @if($daysLeft > 0)
                                <span class="text-success">
                                    {{ round($daysLeft) }} Days Left
                                </span>
                            @else
                                <span class="text-danger">Expired</span>
                            @endif
                        </td>

                        <td>
                            @if($warranty->type == 'Manufacturer' && $warranty->status == 'Active' && $daysLeft <= 6000)
                                <a href="{{ route('customer.extended.warranty.create', $warranty->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Extend Warranty
                                </a>
                            @elseif($warranty->type == 'Extended')
                                <span class="badge bg-secondary">Extended</span>
                            @else
                                <span class="text-muted">Not Available</span>
                            @endif
                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="alert alert-info">
            You don't have any warranty yet.
        </div>

    @endif

</div>

</body>
</html>