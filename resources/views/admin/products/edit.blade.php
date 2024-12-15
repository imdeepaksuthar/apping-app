@extends('theme.default')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Products</h1>
    <ol class="breadcrumb mb-4 bg-light p-3 rounded">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">Update Products</li>
    </ol>
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Update Products
        </div>
        <div class="card-body">
            <div class="d-flex mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            <form id="productForm" action="{{ route('products.update', $product->id ) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Category Dropdown -->
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="" selected disabled>Choose a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category', $product->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Price Field -->
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter price" value="{{ old('price',$product->price ) }}" required>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    // Form validation on submit
    document.getElementById('productForm').addEventListener('submit', function(event) {
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
