@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, {{ Auth::user()->name }}                        
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if (!empty(Auth::user()->image))
                        <img src="{{ url('uploads/profile/' . Auth::user()->image) }}" class="img-fluid rounded-circle" alt="{{ Auth::user()->full_name }}">
                    @endif
                    </div>
                    <div class="h5 text-center">
                        <strong>{{ Auth::user()->name }}</strong>
                        <p class="h6 mt-2 text-muted">
                            @if(Auth::user()->role === 'tenant')
                                Tenant
                            @elseif(Auth::user()->role === 'homeowner')
                                Homeowner
                            @else
                                User - Undefined!!
                            @endif </p>
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
                            <a href="view.html">View Profile</a>                               
                        </li>
                        <li class="nav-item">
                            <a href="#"> Property Listing</a>                               
                        </li>
                        <li class="nav-item">
                            <a href="#"> All Property </a>                               
                        </li>
                        <li class="nav-item">
                            <a href="change-password.html">Change Password</a>
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
                <div class="card-header  text-white">
                    Profile
                </div>
                
            </div>                
        </div>
    </div>       
</div>    
@endsection