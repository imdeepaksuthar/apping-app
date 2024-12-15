@extends('theme.default')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Category</h1>
    <ol class="breadcrumb mb-4 bg-light p-3 rounded">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Add Category</li>
    </ol>
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Add Category
        </div>
        <div class="card-body">
            <div class="d-flex mb-3">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter category name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    // Form validation on submit
    document.getElementById('categoryForm').addEventListener('submit', function(event) {
        var form = this;

        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            console.log(form);

        }
        form.classList.add('was-validated');
    });
</script>
@endpush
