{{-- resources/views/Admin/Candidate/add_candidate.blade.php --}}
@extends('Admin.adminlayout.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-center">Add New Candidate</h2>

            <form action="{{ route('admin.store_candidate') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">Candidate Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="level" class="form-label">Level</label>
                    <input type="text" name="level" id="level" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="programme" class="form-label">Programme</label>
                    <input type="text" name="programme" id="programme" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="manifesto" class="form-label">Manifesto</label>
                    <textarea name="manifesto" id="manifesto" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Candidate Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Qualified" selected>Qualified</option>
                        <option value="Disqualified">Disqualified</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Submit Candidate</button>
                    <a href="{{ route('Admin.addcandidate') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection