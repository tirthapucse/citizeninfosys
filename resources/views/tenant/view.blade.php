@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
                            Tenant Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @if (!empty(Auth::user()->tenant->image))
                                    <img src="{{ asset('private/' . Auth::user()->tenant->image) }}" class="img-fluid rounded-circle" alt="{{ Auth::user()->full_name }}">
                                @endif                            
                            </div>
                            <div class="h5 text-center">
                                @if(Auth::user()->role === 'tenant')
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <p class="h6 mt-2 text-muted">Tenant</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-lg mt-3">
                        <div class="card-header text-white">
                            Navigation
                        </div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('tenant.dashboard') }}">My Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tenant.view') }}">View Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tenant.requests') }}" class="nav-link">Requests</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tenant.dashboard') }}">Edit Profile</a>                               
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
                    <div class="card border-0 shadow">
                        <div class="card">
                            <div class="card-header">
                                <p>Full Profile</p>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($tenant->image)
                                                <img src="{{ asset('private/' . $tenant->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                                            @else
                                                <span>No image uploaded</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Full Name</th>
                                        <td>{{ $tenant->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>National ID</th>
                                        <td>{{ $tenant->national_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $tenant->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $tenant->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $tenant->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Profession</th>
                                        <td>{{ $tenant->profession }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>{{ ucfirst($tenant->marital_status) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>{{ $tenant->religion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{ ucfirst($tenant->gender) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Present Location</th>
                                        <td>
                                            @if ($tenant->rent)
                                                {{ $tenant->rent->property->building_address }}
                                            @else
                                                <span class="text-muted">No property assigned</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('tenant.dashboard') }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>       
        </div>
    </section>
@endsection
