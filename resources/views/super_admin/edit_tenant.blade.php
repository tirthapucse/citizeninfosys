@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Edit Tenant</h1>
    <form action="{{ route('superadmin.tenants.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $tenant->full_name }}" required>
        </div>
        <div class="form-group">
            <label for="national_id">National ID</label>
            <input type="text" name="national_id" class="form-control" value="{{ $tenant->national_id }}">
        </div>
        <div class="form-group">
            <label for="passport_number">Passport Number</label>
            <input type="text" name="passport_number" class="form-control" value="{{ $tenant->passport_number }}">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control">
                <option value="male" {{ $tenant->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $tenant->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $tenant->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $tenant->address }}">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="{{ $tenant->city }}">
        </div>
        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" name="profession" class="form-control" value="{{ $tenant->profession }}">
        </div>
        <div class="form-group">
            <label for="marital_status">Marital Status</label>
            <input type="text" name="marital_status" class="form-control" value="{{ $tenant->marital_status }}">
        </div>
        <div class="form-group">
            <label for="religion">Religion</label>
            <input type="text" name="religion" class="form-control" value="{{ $tenant->religion }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection