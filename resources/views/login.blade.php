<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Voting System</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                margin: 100px auto 0;
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

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('authenticate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') @enderror" id="email" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') @enderror" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>