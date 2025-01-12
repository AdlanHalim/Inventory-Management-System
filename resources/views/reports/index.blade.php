<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Inventory Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index') }}">Sales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reports.index') }}">Reports</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container my-5">
    <h1 class="text-center mb-4">Sales Report</h1>

    <!-- Summary Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="p-3 bg-light border rounded">
                <h5>Total Revenue</h5>
                <p class="fs-4">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-light border rounded">
                <h5>Total Sales</h5>
                <p class="fs-4">{{ $totalSales }}</p>
            </div>
        </div>
    </div>

    <!-- Sales by Product Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Total Quantity Sold</th>
            <th>Total Revenue</th>
        </tr>
        </thead>
        <tbody>
        @foreach($salesByProduct as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->total_quantity }}</td>
                <td>${{ number_format($product->total_revenue, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
