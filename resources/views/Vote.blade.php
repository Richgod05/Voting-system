
@extends('layout.app')

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
</style>

@section('content')
    <h2>Vote for Your Favorite Candidate</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach ($candidates as $candidate)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>{{ $candidate->name }}</h5>
                        <p>{{ $candidate->manifesto }}</p>
                        <form action="{{ route('vote.cast') }}" method="POST">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" class="btn btn-primary">Vote</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection