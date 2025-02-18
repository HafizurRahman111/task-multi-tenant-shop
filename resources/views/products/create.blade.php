@extends('layouts.app')

@section('title', 'Create New Product')

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

        .image-preview {
            max-width: 150px;
            max-height: 150px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
        }

        /* For image file input */
        .custom-file-input:lang(en) {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row align-items-center mb-1">
            <div class="col-md-6">
                <h2>Create New Product</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route($routes['index']) }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Product Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route($routes['store']) }}" method="POST" id="product-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} (Under Store: {{ $category->store->name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Product Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control form-control-sm @error('product_name') is-invalid @enderror"
                                       name="product_name" id="product_name" value="{{ old('product_name') }}" required maxlength="250">
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control form-control-sm @error('price') is-invalid @enderror"
                                       name="price" id="price" value="{{ old('price') }}" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock">Stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm @error('stock') is-invalid @enderror"
                                       name="stock" id="stock" value="{{ old('stock') }}" min="1" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                                          name="description" id="description" rows="6" required maxlength="500">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image (Max 2MB, JPG, PNG, JPEG, GIF)</label>
                                <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror"
                                       name="image" id="image" accept="image/*" onchange="previewImage(event)">
                                <img id="image-preview" class="image-preview" src="#" alt="Image Preview">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
    <script>
        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('product-form').addEventListener('submit', function (e) {
            const product_name = document.getElementById('product_name');
            const category_id = document.getElementById('category_id');
            const description = document.getElementById('description');
            const price = document.getElementById('price');
            const stock = document.getElementById('stock');
            const image = document.getElementById('image');

            if (!product_name.value || !category_id.value || !description.value || !price.value || !stock.value || !image.files.length) {
                alert('Please fill in all required fields and select an image!');
                e.preventDefault();
            }
        });
    </script>
@endsection
