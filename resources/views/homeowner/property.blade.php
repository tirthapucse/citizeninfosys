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
                                    <label for="building_name">Building Name</label>
                                    <input type="text" name="building_name" id="building_name" class="form-control" value="{{ old('building_name') }}">
                                    @error('building_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="building_address">Building Address</label>
                                    <input type="text" name="building_address" id="building_address" class="form-control" value="{{ old('building_address') }}">
                                    @error('building_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="building_image">Building Image</label>
                                    <input type="file" name="building_image" id="building_image" class="form-control">
                                    @error('building_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label for="holding_number">Holding Number</label>
                                    <input type="text" name="holding_number" id="holding_number" class="form-control" value="{{ old('holding_number') }}">
                                    @error('holding_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label for="holding_tax_number">Holding Tax Number</label>
                                    <input type="text" name="holding_tax_number" id="holding_tax_number" class="form-control" value="{{ old('holding_tax_number') }}">
                                    @error('holding_tax_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label for="google_map_link">Google Map Link</label>
                                    <input type="url" name="google_map_link" id="google_map_link" class="form-control" value="{{ old('google_map_link') }}">
                                    @error('google_map_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label for="total_flat">Total Flat</label>
                                    <input type="text" name="total_flat" id="total_flat" class="form-control" value="{{ old('total_flat') }}">
                                    @error('total_flat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label for="total_floor">Total Floor</label>
                                    <input type="text" name="total_floor" id="total_floor" class="form-control" value="{{ old('total_floor') }}">
                                    @error('total_floor')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Create Property</button>
                            </form>
                        </div>
                    </div>

                    <!-- Display Existing Properties -->
                    <div class="card border-0 shadow mt-4">
                        <div class="card-header  text-white">
                            Your Properties
                        </div>
                        <div class="card-body">
                            @if ($properties->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Building Name</th>
                                            <th>Building Address</th>
                                            <th>Holding Number</th>
                                            <th>Total Flats</th>
                                            <th>Total Floors</th>
                                            {{-- <th>Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($properties as $property)
                                            <tr>
                                                <td>{{ $property->building_name }}</td>
                                                <td>{{ $property->building_address }}</td>
                                                <td>{{ $property->holding_number }}</td>
                                                <td>{{ $property->total_flat }}</td>
                                                <td>{{ $property->total_floor }}</td>
                                                {{-- <td>
                                                    <a href="{{ route('property.edit', $property->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('property.destroy', $property->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this property?')">Delete</button>
                                                    </form>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No properties found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </section>
@endsection