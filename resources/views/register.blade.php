<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Voting System - Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Nunito font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 2rem 1rem;
        }
        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 0 auto;
        }
        .card-header {
            background-color: #072A6C;
            color: white;
            text-align: center;
            padding: 1.5rem 1rem 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .logo-wrapper {
            margin-top: 0.75rem;
            text-align: center;
        }
        .logo-wrapper img {
            height: 50px;
        }
        .form-control {
            border-radius: 0.25rem;
            font-weight: 400;
        }
        .btn-primary {
            background-color: #072A6C;
            border: none;
            font-weight: 600;
        }
        .login-link {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.95rem;
        }
        .login-link a {
            color: #072A6C;
            text-decoration: underline;
            font-weight: 600;
        }
        @media (min-width: 768px) {
            .card-wrapper {
                max-width: 600px;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card-wrapper">
            <div class="card">
                <div class="card-header">
                    College Voting System
                    <div class="logo-wrapper">
                        <img src="{{ asset('images/CBE.png') }}" alt="CBE Logo">
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('process_register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Repeat Password</label>
                            <input type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <div class="login-link">
                        Already have an account?
                        <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>