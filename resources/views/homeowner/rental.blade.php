@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
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
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <p class="h6 mt-2 text-muted">Homeowner</p>
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
                    <div class="container">
                        <h2>Search Tenant</h2>
                        
                        <form action="{{ route('homeowner.searchTenant') }}" method="GET">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or ID">
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </form>
                        
                        @if(isset($tenants))
                            <h3 class="mt-4">Search Results</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tenants as $tenant)
                                        <tr>
                                            <td>{{ $tenant->full_name }}</td>
                                            <td>{{ $tenant->id }}</td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#requestModal" data-tenant-id="{{ $tenant->id }}">
                                                    Send Request
                                                </button>
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

    <!-- Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Send Request to Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('homeowner.sendRequest') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tenant_id" id="tenant_id">
                        <div class="mb-3">
                            <label for="property_id" class="form-label">Select Property</label>
                            <select class="form-control" name="property_id" id="property_id" required>
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->building_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var requestModal = document.getElementById('requestModal');
            requestModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var tenantId = button.getAttribute('data-tenant-id');
                document.getElementById('tenant_id').value = tenantId;
            });
        });
    </script>
@endsection
