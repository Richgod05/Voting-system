<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('password.sendreset') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>