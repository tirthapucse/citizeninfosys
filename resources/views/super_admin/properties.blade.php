@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg mt-3">
                        <div class="card-header text-white">
                            Navigation
                        </div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.properties') }}">Properties List</a>                               
                                </li>
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
                            Properties List
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>Building Address</th>
                                        <th>Homeowner</th>
                                        <th>Holding Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($properties as $property)
                                    <tr>
                                        <td>{{ $property->building_name }}</td>
                                        <td>{{ $property->building_address }}</td>
                                        <td>{{ $property->homeowner->full_name }}</td>
                                        <td>{{ $property->holding_number }}</td>

                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('superadmin.properties.edit', $property->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        
                                            <!-- Delete Button -->
                                            <form action="{{ route('superadmin.properties.delete', $property->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
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