<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HealthyCalc')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(to right, #e8f9f3, #d4efdf);
            font-family: 'Roboto', Arial, sans-serif;
            /* Modern font */
        }

        main {
            flex: 1;
        }

        .navbar {
            background-color: #2ecc71;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .navbar:hover {
            background-color: #27ae60;
        }

        .navbar a {
            color: white !important;
            font-size: 1.1rem;
            /* Slightly larger font size for readability */
            font-weight: 500;
            /* Medium weight for menu items */
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .navbar a:hover {
            color: #d4efdf;
            transform: scale(1.1);
        }

        .footer {
            background-color: #27ae60;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 0.9rem;
            /* Slightly smaller footer text */
        }

        .card {
            border-radius: 15px;
            margin-bottom: 20px;
            /* Add spacing between cards */
        }

        .btn-primary {
            background-color: #2ecc71;
            border-color: #27ae60;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }

        .table thead {
            background-color: #2ecc71;
            color: white;
            font-weight: 700;
            /* Bold header text */
        }

        .table tbody td {
            font-size: 0.95rem;
            /* Slightly smaller font for table body */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-weight: 700; font-size: 1.3rem;">HealthyCalc</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('simulasi-defisit.index') }}">Simulasi Defisit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; 2025 HealthyCalc. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>