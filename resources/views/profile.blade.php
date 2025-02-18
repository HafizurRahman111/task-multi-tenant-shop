@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <h2 class="mb-4">Profile</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tenant Information -->
                <div class="mb-5">
                    <h4>Tenant Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('assets/images/default/tenant-default-logo.png') }}" alt="Tenant Logo"
                                class="rounded-circle mb-3" width="100" height="100">
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Tenant Name:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $tenant->name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Email:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $tenant->email ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Created At:</strong>
                                </div>
                                <div class="text-muted col-sm-9">
                                    {{ $tenant->created_at->format('d/m/Y - h:i a') ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Information -->
                <div>
                    <h4>User Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('assets/images/default/default-user.png') }}" alt="Profile Picture"
                                class="rounded-circle mb-3" width="150" height="150">
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Name:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Email:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Role:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ ucfirst($user->role) }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Joined:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $user->created_at->format('d/m/Y - h:i a') ?? 'N/A'  }}
                                </div>
                            </div>
                            <!-- <a href="#" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection