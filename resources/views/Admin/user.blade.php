@extends('Admin.adminlayout.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Admin Users</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($adminUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status ?? 'active' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No admin users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection