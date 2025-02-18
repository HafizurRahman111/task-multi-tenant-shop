@extends('layouts.app')

@section('title', 'Edit Category')

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
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h2>Edit Category</h2>
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
                <form action="{{ route($routes['update'], $category->id) }}" method="POST" id="category-form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Store Selection -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="store_id">Store <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm @error('store_id') is-invalid @enderror"
                                    name="store_id" id="store_id" required>
                                    <option value="">Select Store</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ old('store_id', $category->store_id) == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Category Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
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
        document.getElementById('category-form').addEventListener('submit', function (e) {
            const name = document.getElementById('name');
            const store = document.getElementById('store_id');

            if (!name.value || !store.value) {
                alert('Please fill in all required fields!');
                e.preventDefault();
            }
        });
    </script>
@endsection