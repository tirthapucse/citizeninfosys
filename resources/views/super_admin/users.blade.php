@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header  text-white">
                            SuperAdmin Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                                       
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
                        <div class="card-header  text-white">
                            Navigation
                        </div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
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
                        <div class="card-header text-white">Manage Users</div>
                            <!-- User Table -->
                            <table class="w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->role ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <!-- Delete Button -->
                                                <form action="{{ route('superadmin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-secondary">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center border border-gray-300 px-4 py-2">No users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        
                    </div>            
                </div>
            </div>       
        </div>
    </section>
@endsection