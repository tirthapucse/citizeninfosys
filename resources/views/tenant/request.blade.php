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
                    <div class="container">
                        <h2>Rental Requests</h2>
                    
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    
                        @if($rentalRequests->isEmpty())
                            <p>No rental requests at the moment.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Building ID</th>
                                        <th>Homeowner</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rentalRequests as $request)
                                        <tr>
                                            <td>{{ $request->property_id }}</td>
                                            <td>{{ $request->property->homeowner->full_name }}</td>
                                            <td>
                                                <form action="{{ route('tenant.acceptRequest') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="tenant_id" value="{{ $request->tenant_id }}">
                                                    <input type="hidden" name="property_id" value="{{ $request->property_id }}">
                                                    <button type="submit" class="btn btn-success">Accept Request</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>  
                </div>
            </div>       
        </div>
    </section>
@endsection
