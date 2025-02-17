@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <!-- Sidebar -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white">
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
                        <div class="card-header bg-primary text-white">Navigation</div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="{{ route('account.logout') }}" class="nav-link">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-9">
                    @include('layouts.message')
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white">Search</div>
                        <div class="card-body">
                            <form action="{{ route('security_admin.search') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Search tenants/homeowners">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
