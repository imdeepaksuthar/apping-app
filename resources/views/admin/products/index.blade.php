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
                <!-- Add Category Button -->
                <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-1"></i>Add Product</a>
            </div>
            <table class="table table-bordered" id="products-data-table">
                <thead>
                    <tr>
                        <th width="10px" >#</th>
                        <th >Name</th>
                        <th >Category Name</th>
                        <th >Price</th>
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
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
        var table = $('#products-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'category_name', name: 'category_name'},
                {data: 'price', name: 'price'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function (data, type, row) {
                        return `
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
                    success: function (response) {
                        Swal.fire('Deleted!', 'The category has been deleted.', 'success');
                        $('#products-data-table').DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        Swal.fire('Error!', 'There was an issue deleting the category.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
