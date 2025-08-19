@extends('Admin.adminlayout.layout')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body, .voting-results {
        font-family: 'Nunito', sans-serif;
    }
    .voting-results {
        padding: 2rem 1rem;
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
</style>
@endsection

@section('content')
<div class="voting-results">
    <h2>Voting Results</h2>
    <table class="results-table">
        <thead>
            <tr>
                <th>Candidate</th>
                <th>Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->votes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection