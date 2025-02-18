@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="mb-4">Dashboard</h2>
    <div class="row g-4">
        @if ($isAdmin)
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow border-0 hover-scale">
                    <div class="d-flex align-items-center">
                        <div class="card-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="fas fa-user-tie fa-lg"></i>
                        </div>
                        <div class="ms-3 text-end flex-grow-1">
                            <h5 class="card-title fw-bold mb-0">Total Tenants</h5>
                            <p class="card-text fs-4 text-primary fw-bold mb-0">{{ $totalTenants }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow border-0 hover-scale">
                    <div class="d-flex align-items-center">
                        <div class="card-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div class="ms-3 text-end flex-grow-1">
                            <h5 class="card-title fw-bold mb-0">Total Merchants</h5>
                            <p class="card-text fs-4 text-success fw-bold mb-0">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow border-0 hover-scale">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-store fa-lg"></i>
                    </div>
                    <div class="ms-3 text-end flex-grow-1">
                        <h5 class="card-title fw-bold mb-0">Total Stores</h5>
                        <p class="card-text fs-4 text-warning fw-bold mb-0">{{ $totalStores }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow border-0 hover-scale">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-tags fa-lg"></i>
                    </div>
                    <div class="ms-3 text-end flex-grow-1">
                        <h5 class="card-title fw-bold mb-0">Total Categories</h5>
                        <p class="card-text fs-4 text-danger fw-bold mb-0">{{ $totalCategories }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card p-3 shadow border-0 hover-scale">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-box-open fa-lg"></i>
                    </div>
                    <div class="ms-3 text-end flex-grow-1">
                        <h5 class="card-title fw-bold mb-0">Total Products</h5>
                        <p class="card-text fs-4 text-info fw-bold mb-0">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection