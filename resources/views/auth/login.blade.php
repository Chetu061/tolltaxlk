<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toll Tax</title>
    
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1514064019862-23e2a332a6a6?q=80&w=2028&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            margin: 0;
        }

        .login-section {
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency */
            padding: 40px;
            border-radius: 10px;
        }
    </style>
    <style>
    /* Apply modern font style and better spacing */
    .text-center p {
        font-size: 1.1rem;
        color: #6c757d;
        font-family: 'Roboto', sans-serif; /* Optional: You can replace this with a different font */
        letter-spacing: 0.5px;
    }

    /* Style the register link */
    .register-link {
        color: #007bff; /* Primary Bootstrap blue */
        text-decoration: none;
        font-weight: bold;
        position: relative;
        transition: color 0.3s ease;
    }

    /* Add a cool hover effect */
    .register-link:hover {
        color: #0056b3; /* Darker blue on hover */
    }

    /* Underline animation on hover */
    .register-link::after {
        content: '';
        position: absolute;
        width: 0%;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #007bff;
        transition: width 0.3s ease;
    }

    .register-link:hover::after {
        width: 100%;
    }
</style>

</head>

<body>

    <!-- Login Form -->
    <section class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container col-lg-4 col-md-6 col-sm-8">
            <div class="login-section shadow-lg p-4">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login To Toll Tax</h3>
                    
                    <!-- Display Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- End of Error Messages -->
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>
                    <div class="text-center mt-4">
    <p class="mb-0">Don't have an account? 
        <a href="{{ route('register') }}" class="register-link">Register here</a>
    </p>
    <p class="mb-0">
        <a href="{{ url("/") }}" class="register-link">Back</a>
    </p>
</div>

                    
                </div>
            </div>
        </div>
    </section>
    <!-- End of Login Form -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>