@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header  text-white">
                            SuperAdmin Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                                       
                            </div>
                            <div class="h5 text-center">
                                @if(Auth::user()->role === 'super_admin')
                                    <div class="h5 text-center">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <p class="h6 mt-2 text-muted">Super Admin</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-lg mt-3">
                        <div class="card-header  text-white">
                            Navigation
                        </div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="book-listing.html">My Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="book-listing.html">View Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('account.logout') }}">Logout</a>
                                </li>                           
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @include('layouts.message') 
                    <div class="d-flex flex-wrap gap-3">
                        <button class="btn btn-primary w-auto p-4 text-start">
                          <p class="mb-2">Registered New Homeowner</p>
                          <p class="fs-4 fw-bold mb-1">{{ $totalOwners }}</p>
                        </button>
                        <button class="btn btn-dark w-auto p-4 text-start">
                          <p class="mb-2">Registered New Tenants</p>
                          <p class="fs-4 fw-bold mb-1">{{ $totalTenants }}</p>
                        </button>
                        <button class="btn btn-danger w-auto p-4 text-start">
                          <p class="mb-2">Registered New Properties</p>
                          <a href="{{ route('superadmin.properties') }}">
                          <p class="fs-4 fw-bold mb-1">{{ $totalProperty }}</p>
                        </button>
                        <button class="btn btn-danger w-auto p-4 text-start">
                            <a href="{{ route('superadmin.users') }}" class="btn btn-danger w-auto p-4 text-start text-decoration-none">
                                <p class="mb-2">Total Number of Users</p>
                                <p class="fs-4 fw-bold mb-1">{{ $totalUsers }}</p>
                              </a>
                        </button>
                        <button class="btn btn-danger w-auto p-4 text-start">
                            <a href="{{ route('super_admin.activeuser') }}" class="btn btn-danger w-auto p-4 text-start text-decoration-none">
                                <p class="mb-2">Homeowners & Tenants</p>
                                
                              </a>
                        </button>
                      </div>
                        </div>
                    </div> 
                        </div>
                    </div>                
                </div>
            </div>       
        </div>
    </section>
@endsection