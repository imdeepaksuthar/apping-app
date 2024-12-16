@extends('theme.default')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product Categories</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-table me-1"></i> Product Categories
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <!-- Add Category Button -->
                    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i
                            class="fas fa-plus-circle me-1"></i>Add Category</a>
                </div>
                <div class="table-responsive">
                    <!-- Make the table scrollable on smaller screens -->
                    <table class="table table-striped table-bordered data-table">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Name</th>
                                <th>Count of Products</th>
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
    <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="viewCategoryModalLabel">Category Details</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Modal content layout -->
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <p><strong>ID:</strong> <span id="category-id"></span></p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p><strong>Name:</strong> <span id="category-name"></span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <p><strong>Count of Products:</strong> <span id="category-count"></span></p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p><strong>Description:</strong> <span id="category-description"></span></p>
                            </div>
                        </div>
                        <!-- Example additional details -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="product-list">
                                    <!-- Rows will be populated dynamically -->
                                </tbody>
                            </table>
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
            var table = $('.data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'count_product',
                        name: 'count_product'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                            <button type="button" class="btn btn-info btn-sm view-category" onclick="return fetchAndShowCategoryDetails(${row.id})">View</button>
                            <a href="categories/${row.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form id="delete-form-${row.id}" action="categories/${row.id}" method="POST" style="display:inline;" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete(${row.id})">Delete</button>
                            </form>
                        `;
                        }
                    }
                ]
            });
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
                        url: `categories/${id}`,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            '_method': 'DELETE',
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', 'The category has been deleted.', 'success');
                            $('.data-table').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'There was an issue deleting the category.', 'error');
                        }
                    });
                }
            });
        }

        function populateProductList(products) {
            let productRows = '';
            products.forEach(product => {
                productRows += `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>$${product.price}</td>
            </tr>
        `;
            });
            $('#product-list').html(productRows);
        }

        // Function to handle viewing category details
        function fetchAndShowCategoryDetails(categoryId) {
            // Fetch category details via AJAX
            $.ajax({
                url: `categories/${categoryId}`,
                type: 'GET',
                success: function(data) {
                    $('#category-id').text(data.id);
                    $('#category-name').text(data.name);
                    $('#category-count').text(data.count_product);
                    $('#category-description').text(data.description || 'No description available');

                    // Populate products if available
                    populateProductList(data.products || []);

                    $('#viewCategoryModal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Unable to fetch category details.', 'error');
                }
            });
        }
    </script>
@endpush
