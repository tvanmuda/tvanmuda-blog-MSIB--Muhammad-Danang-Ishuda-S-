<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog MSIB')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #c0392b;
            --dark-red: #8e2a1f;
            --light-red: #e74c3c;
            --primary-black: #2c3e50;
            --light-black: #34495e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--primary-black);
        }
        .navbar {
            background-color: var(--primary-red);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .nav-link:hover {
            color: #f8f9fa !important;
        }
        .card {
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            background-color: #ffffff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,.1);
        }
        .btn-primary {
            background-color: var(--primary-red);
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--dark-red);
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
            background-color: var(--primary-black);
            color: #ffffff;
        }
        .text-primary {
            color: var(--primary-red) !important;
        }
        .bg-primary {
            background-color: var(--primary-red) !important;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('frontend.home') }}">
                <i class="fas fa-blog"></i> Blog MSIB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.home') }}">Home</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn nav-link">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-shrink-0">
        <div class="container py-4">
            @yield('content')
        </div>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Blog MSIB. Muhammad Danang Ishuda S.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>