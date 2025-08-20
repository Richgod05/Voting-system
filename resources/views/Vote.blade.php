@extends('layout.app')

@section('styles')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif !important;
            padding-bottom: 100px; 
        }
        .container {
            margin-bottom: 80px; 
        }
        .candidate-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 15px;
            background-color: #fff;
        }
        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        .candidate-info {
            flex: 1;
            padding-right: 15px;
        }
        .candidate-card-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .card-title {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .card-text {
            color: #555;
            font-size: 0.95rem;
            margin-bottom: 0.3rem;
        }
        .vote-btn {
            font-weight: 600;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .candidate-card {
                flex-direction: column;
                text-align: center;
            }
            .candidate-info {
                padding-right: 0;
                padding-bottom: 10px;
            }
            .candidate-card-img {
                width: 100%;
                height: auto;
            }
        }
    </style>
@endsection

@section('content')
<div class="container py-5 mb-5">
    <h2 class="mb-4 text-center">Vote for Your Favorite Candidate</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 g-4">
        @foreach ($candidates as $candidate)
            <div class="col">
                <div class="card candidate-card">
                    <div class="candidate-info">
                        <h5 class="card-title">{{ $candidate->name }}</h5>
                        <p class="card-text"><strong>Level:</strong> {{ $candidate->level }}</p>
                        <p class="card-text"><strong>Programme:</strong> {{ $candidate->programme }}</p>
                        <p class="card-text"><strong>Position:</strong> {{ $candidate->position }}</p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($candidate->manifesto, 100, '...') }}</p>
                        <form
                            action="{{ route('vote.cast') }}"
                            method="POST"
                            class="vote-form"
                            data-name="{{ $candidate->name }}"
                        >
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" class="btn btn-primary vote-btn"
                                data-voted="{{ $hasVoted ? 'true' : 'false'}}"
                                data-candidate-id="{{ $candidate->id }}">
                                Vote Now
                            </button>
                        </form>
                    </div>
                    @php
                        $imagePath = file_exists(public_path('images/' . $candidate->image))
                        ? 'images/' . $candidate->image
                        : 'images/profile.png';
                    @endphp
                    <img src="{{ asset($imagePath) }}" alt="{{ $candidate->name }}" class="candidate-card-img">
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.vote-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const candidateName = this.dataset.name;
            const message = `You are about to vote for ${candidateName}.\n\nClick OK to confirm or Cancel to go back.`;
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    const voteButtons = document.querySelectorAll('.vote-btn');
    const alreadyVoted = Array.from(voteButtons).some(btn => btn.dataset.voted === "true");

    if (alreadyVoted) {
        voteButtons.forEach(btn => btn.style.display = 'none');
    }

    voteButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            voteButtons.forEach(b => {
                b.style.display = 'none';
                b.dataset.voted = "true";
            });
        });
    });
});
</script>
@endsection