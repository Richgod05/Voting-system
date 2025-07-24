<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Voting System - Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Nunito Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Nunito', sans-serif;
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
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 38px;
            cursor: pointer;
            font-size: 1.2rem;
            color: #6c757d;
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
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            <i class="bi bi-eye eye-icon" data-target="password"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Repeat Password</label>
                            <input type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation" name="password_confirmation" required>
                            <i class="bi bi-eye eye-icon" data-target="password_confirmation"></i>
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

    <!-- Password toggle script -->
    <script>
        document.querySelectorAll('.eye-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                const targetId = icon.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    </script>
</body>
</html>