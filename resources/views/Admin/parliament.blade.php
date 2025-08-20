@extends('Admin.adminlayout.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Member of Parliament Candidates</h2>
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
                    <th>Position</th> {{-- ✅ New column --}}
                    <th>Image</th>    {{-- ✅ Replacing Candidate ID --}}
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $qualified = $candidates->where('position', 'Member of Parliament (MPs)'); @endphp

                @forelse($qualified as $index => $candidate)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->level }}</td>
                        <td>{{ $candidate->programme }}</td>
                        <td>{{ $candidate->manifesto }}</td>
                        <td>{{ $candidate->position ?? 'N/A' }}</td> 
                        <td>
                            @php
                                $imagePath = file_exists(public_path('images/' . $candidate->image))
                                    ? 'images/' . $candidate->image
                                    : 'images/profile.png';
                            @endphp
                            <img src="{{ asset($imagePath) }}" alt="Candidate Image" width="60" height="60" class="rounded-circle">

                        </td>
                        <td>
                            <span class="badge bg-success">Qualified</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Member of Parliament candidates found.</td> 
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection