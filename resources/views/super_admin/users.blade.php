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
                            Users List
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @if($user->role == 'tenant' || $user->role == 'homeowner')
                                                <form action="{{ route('superadmin.users.verify', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        @if($user->verified) disabled @endif>
                                                        {{ $user->verified ? 'Verified' : 'Approve' }}
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('superadmin.users.delete', $user->id) }}" method="POST" style="display:inline;">
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