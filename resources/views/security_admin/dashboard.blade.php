{{-- @extends('layouts.app')

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
                    <div class="card border-0 shadow">
                        <div class="card-header text-white">Security Admin Dashboard</div>
                        <div class="card-body">
                            <div class="container">
                                <h2></h2>

                                <!-- Search Form -->
                                <form id="searchForm" class="mb-4">
                                    <div class="d-flex gap-2">
                                        <input type="text" name="name" class="form-control" placeholder="Search by Name">
                                        <input type="text" name="nid" class="form-control" placeholder="Search by NID">
                                        <input type="text" name="phone" class="form-control" placeholder="Search by Phone">
                                        <input type="text" name="location" class="form-control" placeholder="Search by Location">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                                <!-- Search Results -->
                                <div id="results">
                                    <h3>Search Results:</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>NID</th>
                                                <th>Phone</th>
                                                <th>Location</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Results will be appended dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <script>
                                // Handle Form Submission for Search
                                document.getElementById('searchForm').addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const searchUrl = '{{ route('security.admin.search') }}';

                                    fetch(searchUrl + '?' + new URLSearchParams(new FormData(this)))
                                        .then(response => response.json())
                                        .then(data => {
                                            const tbody = document.querySelector('#results tbody');
                                            tbody.innerHTML = ''; // Clear previous results

                                            data.forEach(user => {
                                                const row = document.createElement('tr');
                                                row.innerHTML = `
                                                    <td>${user.name || 'N/A'}</td>
                                                    <td>${user.national_id || 'N/A'}</td>
                                                    <td>${user.phone || 'N/A'}</td>
                                                    <td>${user.address || 'N/A'}</td>
                                                    <td>${user.type === 'tenant' ? 'Tenant' : 'Homeowner'}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-secondary" onclick="printUser(${user.id})">Print</button>
                                                    </td>
                                                `;
                                                tbody.appendChild(row);
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                        });
                                });

                                // Print User Info
                                function printUser(userId) {
                                    alert('Print functionality for User ID: ' + userId);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}



{{-- In resources/views/security_admin/dashboard.blade.php --}}
{{-- <form method="GET" action="{{ route('security_admin.search') }}">
    <input type="text" name="name" placeholder="Search by Name" />
    <input type="email" name="email" placeholder="Search by Email" />
    <select name="role">
        <option value="">Select Role</option>
        <option value="tenant">Tenant</option>
        <option value="homeowner">Homeowner</option>
    </select>
    <input type="text" name="national_id" placeholder="Search by National ID" />
    <input type="text" name="city" placeholder="Search by City" />
    <button type="submit">Search</button>
</form>

{{-- Display the list of users --}}
{{-- @foreach ($users as $user)
    <div>
        <p>{{ $user->name }} - {{ $user->email }} - {{ $user->role }}</p>
        <a href="{{ route('security_admin.print', $user->id) }}">Download/Print Data</a>
    </div>
@endforeach  --}}

<form action="{{ route('security_admin.search') }}" method="GET">
    <input type="text" name="query" placeholder="Search tenants/homeowners">
    <button type="submit">Search</button>
</form>

