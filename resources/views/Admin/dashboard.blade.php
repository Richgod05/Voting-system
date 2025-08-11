@extends('Admin.adminlayout.layout')

@section('content')
<div class="sidebar">
    <div class="accordion" id="sidebarAccordion">

        <!-- Admin -->
        <a href="{{ route('admin.user') }}" class="d-flex align-items-center px-4 py-2">
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
        <a href="{{ route('admin.candidate') }}" class="d-flex align-items-center px-4 py-2">
            <i class="bi bi-person-plus"></i> Requested Candidates
        </a>

        <!-- Qualified Candidates -->
        <a href="{{ route('admin.qualifiedcandidates') }}" class="d-flex align-items-center px-4 py-2">
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

<style>
    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #072A6C;
        color: white;
        position: fixed;
        top: 80px; /* Adjust based on your header height */
        left: 0;
        overflow-y: auto;
        padding-top: 20px;
        z-index: 1000;
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
</style>
@endsection