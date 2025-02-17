@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option value="tenant" {{ $user->role == 'tenant' ? 'selected' : '' }}>Tenant</option>
                <option value="homeowner" {{ $user->role == 'homeowner' ? 'selected' : '' }}>Homeowner</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection