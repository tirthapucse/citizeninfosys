@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
                            SuperAdmin Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <!-- Add profile image or icon here if needed -->
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
                        <div class="card-header text-white">
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
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
                            Property Information
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tenant Name</th>
                                        <th>Homeowner Name</th>
                                        <th>Property Address</th>
                                        <th>Phone Number</th>
                                        <th>NID</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rents as $rent)
                                    <tr>
                                        <td>{{ $rent->id }}</td>
                                        <td>{{ $rent->tenant->full_name }}</td>
                                        <td>{{ $rent->property->homeowner->full_name }}</td>
                                        <td>{{ $rent->property->building_address }}</td>
                                        <td>{{ $rent->tenant->phone }}</td>
                                        <td>{{ $rent->tenant->national_id }}</td>
                                        <td>
                                            {{-- <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('properties.delete', $property->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection