@extends('layouts.app')

@section('title', 'Create New Tenant')

@section('styles')
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h2>Create New Tenant</h2>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tenant Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tenants.store') }}" method="POST" id="tenant-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tenant Name</label>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Tenant Email</label>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('tenant-form').addEventListener('submit', function (e) {
            const name = document.getElementById('name');
            const email = document.getElementById('email');

            if (!name.value || !email.value) {
                alert('Please fill in all required fields!');
                e.preventDefault();
            }
        });
    </script>
@endsection