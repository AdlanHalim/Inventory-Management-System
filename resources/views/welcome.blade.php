<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .hero {
            text-align: center;
            background: linear-gradient(to right, #4CAF50, #81C784);
            color: white;
            padding: 100px 20px;
            flex: 1;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .hero .btn {
            margin: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
        }
        .about {
            text-align: center;
            padding: 50px 20px;
            flex: 1;
        }
        .about h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .about p {
            font-size: 1rem;
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
        }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Welcome to Inventory Management System</h1>
        <p>Streamline your inventory processes with ease and efficiency.</p>
        <a href="{{ route('login') }}" class="btn btn-success">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
    </div>
    <div class="about">
        <h2>About the System</h2>
        <p>
            This Inventory Management System is designed to help small businesses and SMEs 
            manage their inventory effectively. With real-time updates, automation of manual 
            tasks, and detailed reporting, this system ensures seamless operations.
        </p>
    </div>
    <footer>
        &copy; {{ date('Y') }} Inventory Management System. All Rights Reserved.
    </footer>
</body>
</html>

