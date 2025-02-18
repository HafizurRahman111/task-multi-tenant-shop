@extends('layouts.app')

@section('title', 'Stores')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/data-table.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row mb-1">
            <div class="col">
                <h2 class="mb-0">Stores</h2>
            </div>
            <div class="col-auto">
                @if(isset($routes['create']))
                    <a href="{{ route($routes['create']) }}" class="btn btn-success btn-sm">Add New <i class="fa fa-plus"></i>
                    </a>
                @endif
            </div>
        </div>
        <!-- Table Section -->
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        @if(auth()->user()->role === 'admin')
                            <th>Tenant Name</th>
                        @endif
                        <th>Store Name</th>
                        <th>Website</th>
                        <th>Phone</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Updated</th>
                        <th>Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td data-label="ID">{{ $item->id }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td data-label="Tenant Name">{{ $item->tenant->name }}</td>
                            @endif
                            <td data-label="Store Name">{{ $item->name }}</td>
                            <td data-label="Website">
                                <span class="small">{{ $item->website }}</span>
                                <a href="{{ $item->website }}" class="btn btn-sm btn-outline-primary ms-3" target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa fa-external-link-alt"></i>
                                </a>
                            </td>
                            <td data-label="Phone">{{ $item->phone }}</td>
                            <td data-label="Slug">{{ $item->slug }}</td>
                            <td data-label="Created">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td data-label="Created By">{{ $item->creator->name }}</td>
                            <td data-label="Updated">{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                            <td data-label="Updated By">
                                @if ($item->updatedBy)
                                    {{ $item->updatedBy->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="actions">
                                @if(isset($routes['edit']))
                                    <a href="{{ route($routes['edit'], $item->id) }}" class="btn btn-warning btn-sm"
                                        data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a>
                                @endif
                                @if(isset($routes['delete']))
                                    <form action="{{ route($routes['delete'], $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn" data-toggle="tooltip"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "responsive": {
                    details: {
                        type: 'column',
                        target: 'tr',
                    },
                },
                "responsive": true,
                "order": [[0, 'desc']],
                "columnDefs": [
                    { "responsivePriority": 1, "targets": 0 }, // ID column
                    { "responsivePriority": 2, "targets": -1 }, // Actions column
                ],
            });

            $('[data-toggle="tooltip"]').tooltip();

            $('.delete-btn').on('click', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();

                        toastr.success('Store deleted successfully!', 'Success', {
                            positionClass: 'toast-top-right',
                            timeOut: 5000,
                        });
                    } else {
                        toastr.info('Deletion cancelled.', 'Cancelled', {
                            positionClass: 'toast-top-right',
                            timeOut: 5000,
                        });
                    }
                });
            });

            @if (session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    positionClass: 'toast-top-right',
                    timeOut: 5000,
                });
            @elseif (session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    positionClass: 'toast-top-right',
                    timeOut: 5000,
                });
            @endif
        });
    </script>
@endsection