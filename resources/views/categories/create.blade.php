@extends('layouts.app')

@section('title', 'Create New Category')

@section('styles')
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            padding: 20px;
        }

        .invalid-feedback {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .single-row-form {
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }

        .single-row-form .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .submit-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h2>Create New Category</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route($routes['index']) }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route($routes['store']) }}" method="POST" id="category-form">
                    @csrf
                    <div class="single-row-form">
                        <div class="form-group">
                            <label for="store_id">Store <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm @error('store_id') is-invalid @enderror"
                                name="store_id" id="store_id" required>
                                <option value="">Select Store</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('store_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                name="name" id="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="submit-row">
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
    <script>
        document.getElementById('category-form').addEventListener('submit', function (e) {
            const storeId = document.getElementById('store_id');
            const name = document.getElementById('name');

            if (!storeId.value || !name.value) {
                alert('Please fill in all required fields!');
                e.preventDefault();
            }
        });
    </script>
@endsection