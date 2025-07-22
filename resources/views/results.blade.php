@extends('layout.app')

@section('content')
    <h2>Voting Results</h2>
    <table class="table table-bordered">
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
@endsection
