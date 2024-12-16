@extends('theme.default')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-table me-1"></i> Products
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <!-- Add Product Button -->
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-1"></i> Add Product
                    </a>
                </div>

                <!-- Responsive Table Wrapper -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="products-data-table">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Name</th>
                                <th>Category Name</th>
                                <th>Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTable rows will be populated via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Category Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="viewProductModalLabel">Product Details</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Modal content layout -->
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <p><strong>ID:</strong> <span id="product-id"></span></p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p><strong>Name:</strong> <span id="product-name"></span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <p><strong>Category:</strong> <span id="product-category"></span></p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p><strong>Price:</strong> <span id="product-price"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#products-data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                            <button type="button" class="btn btn-info btn-sm view-category" onclick="return fetchAndShowProductDetails(${row.id})">View</button>
                            <a href="products/${row.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form id="delete-form-${row.id}" action="products/${row.id}" method="POST" style="display:inline;" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete(${row.id})">Delete</button>
                            </form>
                        `;
                        }
                    }
                ]
            });
            console.log(table);

        });

        function confirmDelete(id, table) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform AJAX request to delete the category
                    $.ajax({
                        url: `products/${id}`,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            '_method': 'DELETE',
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', 'The category has been deleted.', 'success');
                            $('#products-data-table').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'There was an issue deleting the category.', 'error');
                        }
                    });
                }
            });
        }

        // Function to handle viewing category details
        function fetchAndShowProductDetails(productId) {
            // Fetch category details via AJAX
            $.ajax({
                url: `products/${productId}`,
                type: 'GET',
                success: function(data) {
                    $('#product-id').text(data.id);
                    $('#product-name').text(data.name);
                    $('#product-category').text(data.category);
                    $('#product-price').text('$' + data.price);

                    $('#viewProductModal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Unable to fetch product details.', 'error');
                }
            });
        }
    </script>
@endpush
