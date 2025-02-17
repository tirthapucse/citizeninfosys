@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <!-- Sidebar -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
                            Homeowner Area
                        </div>
                        <div class="card-body text-center">
                            <!-- Display Profile Picture -->
                            @if (!empty(Auth::user()->security_admin->image))
                                <img src="{{ asset('private/' . Auth::user()->security_admin->image) }}" 
                                     class="img-fluid rounded-circle mb-3" 
                                     alt="{{ Auth::user()->full_name }}">
                            @endif

                            <!-- Display User Info -->
                            <strong>{{ Auth::user()->name }}</strong>
                            @if(Auth::user()->role === 'security_admin')
                                <p class="h6 mt-2 text-muted">Security Admin</p>
                            @endif
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="card border-0 shadow-lg mt-3">
                        <div class="card-header text-white">Navigation</div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="{{ route('account.logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-9">
                    @include('layouts.message')
                    <h2>Users List</h2>

                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $tenant)
                                <tr>
                                    <td>{{ $tenant->full_name ?? 'N/A' }}</td>
                                    <td>Tenant</td>
                                    <td>{{ $tenant->user->email ?? 'N/A' }}</td>
                                    <td>{{ $tenant->address ?? 'N/A' }}</td>
                                    <td><button class="btn btn-primary" onclick="window.print()">Print</button></td>
                                </tr>
                            @endforeach
                            
                            @foreach($homeowners as $homeowner)
                                <tr>
                                    <td>{{ $homeowner->full_name ?? 'N/A' }}</td>
                                    <td>Homeowner</td>
                                    <td>{{ $homeowner->user->email ?? 'N/A' }}</td>
                                    <td>{{ $homeowner->address ?? 'N/A' }}</td>
                                    <td><button class="btn btn-primary" onclick="window.print()">Print</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </section>
@endsection








