<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Voting System | Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            padding-top: 80px; /* Adjust if header height changes */
            font-family: 'Nunito', sans-serif;
        }

        .logout-button {
            background-color: #ffffff;
            color: #072A6C;
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .logout-button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <header style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000; background-color: #072A6C; color: white; padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; font-family: 'Nunito', sans-serif;">
        
        <!-- Left Section: Logo and Title -->
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('images/CBE.png') }}" alt="CBE Logo" style="height: 50px; margin-right: 15px;">
            <h1 style="margin: 0; font-size: 1.8rem; font-weight: 700;">College Vote Managment System (Admin Page)</h1>
        </div>

        <!-- Right Section: Username, Profile Image, and Logout -->
        <div style="display: flex; align-items: center;">
            <span style="font-weight: 600; margin-right: 10px;">
                Hello,  {{ Auth::guard('admins')->user()->name ?? 'Admin' }}
            </span>
            <img src="{{ Auth::guard('web')->user()->profile_image_url ?? asset('images/profile.png') }}"
                 alt="Profile Image" style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover; margin-right: 15px;">

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </header>

    <!-- Rest of your page content goes here -->
</body>
</html>