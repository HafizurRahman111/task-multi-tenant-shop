@extends('layouts.app')

@section('title', 'Create New Store')

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
                <h2>Create New Store</h2>
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
                <form action="{{ route($routes['store']) }}" method="POST" id="store-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenant_id">Tenant</label>
                                <select name="tenant_id" id="tenant_id" class="form-control">
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" {{ old('tenant_id', $selectedTenantId) == $tenant->id ? 'selected' : '' }}>
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
                                    name="name" id="name" value="{{ old('name') }}" required onkeyup="generateWebsiteUrl()">
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
                                    name="phone" id="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="protocol">Protocol</label>
                                <select class="form-control form-control-sm" id="protocol" onchange="generateWebsiteUrl()">
                                    <option value="http" selected>HTTP</option>
                                    <option value="https">HTTPS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="baseDomain">Base Domain</label>
                                <input type="text" class="form-control form-control-sm" name="baseDomain" id="baseDomain"
                                    value="localhost:8000" onkeyup="generateWebsiteUrl()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">Website <span class="text-danger">*</span></label>
                                <input type="url"
                                    class="form-control form-control-sm @error('website') is-invalid @enderror"
                                    name="website" id="website" value="{{ old('website') }}" id="website" readonly>
                                @error('website')
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
        document.getElementById('store-form').addEventListener('submit', function (e) {
            const name = document.getElementById('name');
            const website = document.getElementById('website');
            const tenant = document.getElementById('tenant_id');

            if (!name.value || !website.value || !tenant.value) {
                alert('Please fill in all required fields!');
                e.preventDefault();
            }
        });

        function generateWebsiteUrl() {
            const protocol = document.getElementById('protocol').value;
            const baseDomain = document.getElementById('baseDomain').value.trim();
            const storeName = document.getElementById('name').value.trim();

            if (!storeName) {
                document.getElementById('website').value = '';
                return;
            }

            const slug = storeName
                .toLowerCase()
                .replace(/\s+/g, '_')
                .replace(/[^a-z0-9_]/g, '');

            const websiteUrl = `${protocol}://${slug}.${baseDomain}/home`;

            document.getElementById('website').value = websiteUrl;
        }

        document.getElementById('protocol').addEventListener('change', generateWebsiteUrl);
        document.getElementById('baseDomain').addEventListener('input', generateWebsiteUrl);
        document.getElementById('name').addEventListener('input', generateWebsiteUrl);
    </script>
@endsection