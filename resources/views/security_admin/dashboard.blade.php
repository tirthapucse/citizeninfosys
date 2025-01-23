@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header  text-white">
                            SecurityAdmin Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                                       
                            </div>
                            <div class="h5 text-center">
                                @if(Auth::user()->role === 'security_admin')
                                    <div class="h5 text-center">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <p class="h6 mt-2 text-muted">Security Admin</p>
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
                                    <a href="login.html">Logout</a>
                                </li>                           
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @include('layouts.message') 
                        </div>
                    </div>                
                </div>
            </div>       
        </div>
    </section>
@endsection