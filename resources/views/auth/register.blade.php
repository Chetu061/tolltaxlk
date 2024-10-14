<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toll Tax</title>

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/main.css">
</head>

<style>
    body {
        background: url('https://www.agbt.org/wp-content/uploads/2020/06/banner-gm-apply-min.png') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        margin: 0;
    }

    /* Ensure the card is visible and readable while being transparent */
    .card {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 10px;
    }

    .form-label {
        color: #333;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<body>

    <!-- Register Form -->
    <section class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container col-lg-4 col-md-6 col-sm-8 pt-2">
            <div class="card shadow-lg p-4 border-0">
                <div class="card-body">
                    <h3 class="text-center mb-4">Register</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control form-control-lg" id="name"
                                placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" id="email"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password"
                                placeholder="Enter your password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                id="confirmPassword" placeholder="Confirm your password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" name="contact" class="form-control form-control-lg" id="contact"
                                placeholder="Enter your phone number" required>
                            @if ($errors->has('contact'))
                                <div class="error text-danger">{{ $errors->first('contact') }}</div>
                            @endif
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>
                    </form>
                    <div class="text-center mt-4">
                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Register Form -->

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
