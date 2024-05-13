<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{'BMS'}}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Include any CSS files or external libraries -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">


    @auth
    <!-- Apply background styles only if user is not authenticated -->
    <style>
        body {
            background: none;
        }
    </style>
    @else
    <style>
        body {
            /* Set background image */
            background-image: url('{{ asset("image/cms.png") }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
    @endauth
    <style>
        .transparent-glass {
            background: rgba(255, 255, 255, 0); /* Adjust the opacity as needed */
            border: none;
            backdrop-filter: blur(10px); /* Apply a blur effect */
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); /* Box shadow for the glassy effect */
        }

        .transparent-glass .card-header {
            background: rgba(255, 255, 255, 0.5); /* Adjust the opacity as needed */
        }
        .transparent-navbar {
            background: rgba(255, 255, 255, 0.5); /* Adjust the opacity as needed */
            backdrop-filter: blur(20px); /* Apply a blur effect */
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Add a subtle border */
        }

        .transparent-navbar .navbar-nav .nav-link {
            color: black; /* Adjust the link color */
        }

        .transparent-navbar .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 1); /* Adjust the link color on hover */
        }

        .bg-grey {
            background-color: #5271de; /* Adjust the shade of grey as needed */
        }
    </style>
</head>
<body>
    @guest
    <div class="container-fluid text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <h1 style="font-family: 'Great Vibes', cursive; font-size: 5rem; color: black;"></h1>
    </div>
    @endguest
    <nav class="navbar navbar-expand-lg navbar-light @guest bg-transparent transparent-navbar @else bg-grey @endguest">
        <div class="container"  style="background: transparent;">
            <a class="navbar-brand" href="{{ route('home') }}">{{'BMS'}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Add navigation links here -->
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link">Logout</button>
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Include any JavaScript files or external libraries -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
