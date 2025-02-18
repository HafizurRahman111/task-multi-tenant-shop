@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('styles')
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h2>Edit Tenant</h2>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Tenant Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tenants.update', $tenant->id)  }}" method="POST" id="tenant-form">
                    @csrf
                    @if(isset($tenant))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <input type="text" class="form-control form-control-sm" id="created_at" name="created_at"
                                    value="{{ isset($tenant) ? $tenant->created_at->format('Y-m-d H:i:s') : '' }}" readonly
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Tenant Email <span class="text-danger">*</span></label>
                                <input type="email"
                                    class="form-control form-control-sm @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $tenant->email ?? '') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">Updated At</label>
                                <input type="text" class="form-control form-control-sm" id="updated_at" name="updated_at"
                                    value="{{ isset($tenant) ? $tenant->updated_at->format('Y-m-d H:i:s') : '' }}" readonly
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tenant Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $tenant->name ?? '') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> {{ isset($tenant) ? 'Update' : 'Save' }}
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
@endsection