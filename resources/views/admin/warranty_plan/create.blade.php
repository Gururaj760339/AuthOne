<!DOCTYPE html>
<html>
<head>
    <title>Add Warranty Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Add Warranty Plan</h2>

    <form action="{{ route('admin.warranty.plans.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Plan Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Duration (Months)</label>
            <input type="number" name="duration_months" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Maximum KM</label>
            <input type="number" name="max_km" class="form-control">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="engine_coverage" checked>
            <label class="form-check-label">Engine Coverage</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="transmission_coverage" checked>
            <label class="form-check-label">Transmission Coverage</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="electrical_coverage">
            <label class="form-check-label">Electrical Coverage</label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="roadside_assistance">
            <label class="form-check-label">Roadside Assistance</label>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="status" class="form-select">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Save Plan</button>

    </form>

</div>

</body>
</html>