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
                        <div class="card-header  text-white">
                            Create Property
                        </div>
                        <div class="card-body">
                            <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                        
                                <div class="form-group">
                                    <label for="building_image">Building Image</label>
                                    <input type="file" name="building_image" id="building_image" class="form-control">
                                </div>
                        
                                <div class="form-group">
                                    <label for="holding_number">Holding Number</label>
                                    <input type="text" name="holding_number" id="holding_number" class="form-control">
                                </div>
                        
                                <div class="form-group">
                                    <label for="holding_tax_number">Holding Tax Number</label>
                                    <input type="text" name="holding_tax_number" id="holding_tax_number" class="form-control">
                                </div>
                        
                                <div class="form-group">
                                    <label for="google_map_link">Google Map Link</label>
                                    <input type="url" name="google_map_link" id="google_map_link" class="form-control">
                                </div>
                        
                                <div class="form-group">
                                    <label for="total_flat">Total Flat</label>
                                    <input type="text" name="total_flat" id="total_flat" class="form-control">
                                </div>
                        
                                <div class="form-group">
                                    <label for="total_floor">Total Floor</label>
                                    <input type="text" name="total_floor" id="total_floor" class="form-control">
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Create Property</button>
                            </form>
                        </div>
                    </div>                
                </div>
            </div>       
        </div>
    </section>
@endsection





