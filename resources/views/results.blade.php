@extends('layout.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body, .voting-results {
        font-family: 'Nunito', sans-serif;
    }
    .voting-results {
        padding: 2rem 1rem;
        margin-bottom: 5rem;
    }
    .voting-results h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-weight: 700;
        color: #333;
    }
    .results-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }
    .results-table thead {
        background-color: #f8f9fa;
    }
    .results-table th, 
    .results-table td {
        padding: 0.75rem 1rem;
        text-align: center;
        color: #444;
        vertical-align: middle;
    }
    .results-table th {
        font-weight: 600;
        color: #222;
    }
    .results-table tbody tr:nth-child(even) {
        background-color: #fafafa;
    }
    .results-table tbody tr:hover {
        background-color: #f1f1f1;
    }
    .candidate-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Mobile optimization */
    @media (max-width: 600px) {
        .results-table th, .results-table td {
            padding: 0.5rem;
            font-size: 0.875rem;
        }
        .candidate-img {
            width: 40px;
            height: 40px;
        }
    }
</style>
@endsection

@section('content')
<div class="voting-results">
    <h2>Voting Results</h2>
    <div class="table-responsive">
        <table class="results-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Candidate Name</th>
                    <th>Position</th>
                    <th>Votes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $candidate)
                    <tr>
                        <td>
                            @php
                                $imagePath = file_exists(public_path('images/' . $candidate->image)) && !empty($candidate->image)
                                    ? 'images/' . $candidate->image
                                    : 'images/profile.png';
                            @endphp
                            <img src="{{ asset($imagePath) }}" alt="Candidate Image" class="candidate-img">
                        </td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->position ?? 'N/A' }}</td>
                        <td>{{ $candidate->votes_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No voting results available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection