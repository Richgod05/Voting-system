@extends('Admin.adminlayout.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Candidate List</h2>
        <a href="{{ route('Admin.addcandidate') }}" class="btn btn-primary">Add Candidate</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Candidate Name</th>
                    <th>Level</th>
                    <th>Programme</th>
                    <th>Manifesto</th>
                    <th>Candidate ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidates as $index => $candidate)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->level }}</td>
                        <td>{{ $candidate->programme }}</td>
                        <td>{{ $candidate->manifesto }}</td>
                        <td>{{ $candidate->candidate_id }}</td>
                        <td>
                            <span class="badge {{ $candidate->status === 'Qualified' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $candidate->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No candidates found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection