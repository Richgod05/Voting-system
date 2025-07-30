@extends('Admin.adminlayout.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voting Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #072A6C;
            color: white;
            position: fixed;
            overflow-y: auto;
            padding-top: 20px;
        }
        .sidebar a,
        .sidebar .accordion-body a {
            color: white;
            padding: 8px 20px;
            text-decoration: none !important;
            display: flex;
            align-items: center;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .sidebar a:hover,
        .sidebar .accordion-body a:hover {
            background-color: #0b5ed7;
            transform: translateX(5px);
        }
        .sidebar .accordion-button {
            color: white;
            background-color: transparent;
        }
        .sidebar .accordion-button:focus {
            box-shadow: none;
        }
        .sidebar .accordion-button:not(.collapsed) {
            background-color: #0b5ed7;
        }
        .sidebar i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .logo {
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #ffffff44;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('images/CBE.png') }}" alt="CBE Logo" style="height: 50px; margin-right: 15px;"> Voting
    </div>

    <div class="accordion" id="sidebarAccordion">

        <!-- Admin -->
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center px-4 py-2">
            <i class="bi bi-person-gear"></i> Admin User
        </a>

        <!-- Voters -->
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#votersSubMenu"
                        aria-expanded="false" aria-controls="votersSubMenu">
                    <i class="bi bi-people me-2"></i> Voters
                </button>
            </h2>
            <div id="votersSubMenu" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                <div class="accordion-body ps-4">
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> Diploma</a>
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> Ordinary Diploma</a>
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> Certificate</a>
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> Bachelor</a>
                </div>
            </div>
        </div>

        <!-- Requested Candidates -->
        <a href="#" class="d-flex align-items-center px-4 py-2">
            <i class="bi bi-person-plus"></i> Requested Candidates
        </a>

        <!-- Qualified Candidates -->
        <a href="#" class="d-flex align-items-center px-4 py-2">
            <i class="bi bi-patch-check"></i> Qualified Candidates
        </a>

        <!-- Positions -->
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#positionsSubMenu"
                        aria-expanded="false" aria-controls="positionsSubMenu">
                    <i class="bi bi-people me-2"></i> Available Positions
                </button>
            </h2>
            <div id="positionsSubMenu" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                <div class="accordion-body ps-4">
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> President</a>
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> Members of Parliament(MPs)</a>
                    <a href="#"><i class="bi bi-arrow-right-circle"></i> Chairperson of CRs</a>
                </div>
            </div>
        </div>

        <!-- Votes -->
        <a href="#" class="d-flex align-items-center px-4 py-2">
            <i class="bi bi-bar-chart-line"></i> Votes
        </a>

        <!-- Rules -->
        <a href="#" class="d-flex align-items-center px-4 py-2">
            <i class="bi bi-clipboard-check"></i> Election Rules and Regulation
        </a>

    </div>
</div>

<div class="main-content">
    <div class="container mt-4">
        <div class="row g-4">

            <!-- Total Voters -->
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">Total Voters</h5>
                            <h3>1,245</h3>
                        </div>
                        <i class="bi bi-people-fill display-5"></i>
                    </div>
                </div>
            </div>

            <!-- Requested Candidates -->
            <div class="col-md-3">
                <div class="card text-white bg-danger shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">Requested Candidates</h5>
                            <h3>58</h3>
                        </div>
                        <i class="bi bi-person-plus-fill display-5"></i>
                    </div>
                </div>
            </div>

            <!-- Qualified Candidates -->
            <div class="col-md-3">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">Qualified Candidates</h5>
                            <h3>37</h3>
                        </div>
                        <i class="bi bi-patch-check-fill display-5"></i>
                    </div>
                </div>
            </div>

            <!-- Available Positions -->
            <div class="col-md-3">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">Available Positions</h5>
                            <h3>12</h3>
                        </div>
                        <i class="bi bi-briefcase-fill display-5"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
@endsection