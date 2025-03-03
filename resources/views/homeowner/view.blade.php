@extends('layouts.app')

@include('layouts.message')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header  text-white">
                            Homeowner Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @if (!empty(Auth::user()->homeowner->image))
                                    <img src="{{ asset('private/' . Auth::user()->homeowner->image) }}" class="img-fluid rounded-circle" alt="{{ Auth::user()->full_name }}">
                                @endif                            
                            </div>
                            <div class="h5 text-center">
                                @if(Auth::user()->role === 'homeowner')
                                    <div class="h5 text-center">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <p class="h6 mt-2 text-muted">Homeowner</p>
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
                                    <a href="{{ route('homeowner.dashboard') }}">My Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('homeowner.view') }}">View Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('property.create') }}">Add Property</a>                               
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
                                                    @if ($homeowner->image)
                                                        <img src="{{ asset('private/' . Auth::user()->homeowner->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                                                    @else
                                                        <span>No image uploaded</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Full Name</th>
                                                <td>{{ $homeowner->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>National ID</th>
                                                <td>{{ $homeowner->national_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $homeowner->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td>{{ $homeowner->city }}</td>
                                            </tr>
                                            <tr>
                                                <th>Profession</th>
                                                <td>{{ $homeowner->profession }}</td>
                                            </tr>
                                            <tr>
                                                <th>Marital Status</th>
                                                <td>{{ ucfirst($homeowner->marital_status) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Religion</th>
                                                <td>{{ $homeowner->religion }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ ucfirst($homeowner->gender) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Property</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>QR Code</th>
                                                <td>{!! $qrCode !!}</td>
                                            </tr>
                                        </table>    
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="{{ route('homeowner.dashboard') }}" class="btn btn-primary">Edit Profile</a>
                                    </div>
                                </div>
                            
                        </div>
                    </div>                
                </div>
            </div>       
        </div>
    </section>
@endsection
