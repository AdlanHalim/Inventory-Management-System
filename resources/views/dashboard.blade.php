<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
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


<main class="container my-5">
    <div class="row text-center">
        <h1 class="mb-4">Welcome to the Dashboard</h1>
    </div>
    <div class="row g-4">
        <!-- Products Section -->
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">Manage your inventory, add, edit, and delete products.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light">Go to Products</a>
                </div>
            </div>
        </div>
        <!-- Sales Section -->
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Sales</h5>
                    <p class="card-text">Track sales and monitor performance.</p>
                    <a href="{{ route('sales.index') }}" class="btn btn-light">View Sales</a>
                </div>
            </div>
        </div>
        <!-- Reports Section -->
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">Generate detailed reports to analyze data.</p>
                    <a href="{{ route('reports.index') }}" class="btn btn-light">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Inventory Management System. All rights reserved.</p>
</footer>

</body>
</html>

