<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required>
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>
