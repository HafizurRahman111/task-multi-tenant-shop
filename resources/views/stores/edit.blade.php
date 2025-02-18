@extends('layouts.app')

@section('title', 'Edit Store')

@section('styles')
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet">
    <style>
        .form-control-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center mb-1">
            <div class="col-md-6">
                <h2>Edit Store</h2>
            </div>
            <div class="col-md-6 text-right">
                @if(isset($routes['index']))
                    <a href="{{ route($routes['index']) }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i>
                        Back</a>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Store Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route($routes['update'], $store->id) }}" method="POST" id="store-form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenant_id">Tenant <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm @error('tenant_id') is-invalid @enderror"
                                    name="tenant_id" id="tenant_id" required>
                                    <option value="">Select Tenant</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" {{ old('tenant_id', $store->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                            {{ $tenant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Store Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', $store->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                    name="phone" id="phone" value="{{ old('phone', $store->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">Website <span class="text-danger">*</span></label>
                                <input type="url"
                                    class="form-control form-control-sm @error('website') is-invalid @enderror"
                                    name="website" id="website" value="{{ old('website', $store->website) }}" required>
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('store-form').addEventListener('submit', function (e) {
            const name = document.getElementById('name');
            const location = document.getElementById('location');
            const website = document.getElementById('website');
            const tenant = document.getElementById('tenant_id');

            if (!name.value || !location.value || !website.value || !tenant.value) {
                alert('Please fill in all required fields!');
                e.preventDefault();
            }
        });
    </script>
@endsection