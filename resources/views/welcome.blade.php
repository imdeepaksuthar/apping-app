@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($product->image)
                        <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; margin: auto; padding: 10px;">
                    @else
                        <img src="https://via.placeholder.com/50" class="card-img-top" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover; margin: auto; padding: 10px;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text"><strong>${{ number_format($product->price, 2) }}</strong></p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        <!-- Render pagination links -->
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
