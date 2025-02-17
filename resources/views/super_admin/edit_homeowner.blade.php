@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Edit Homeowner</h1>
    <form action="{{ route('superadmin.homeowners.update', $homeowner->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $homeowner->full_name }}" required>
        </div>
        <div class="form-group">
            <label for="national_id">National ID</label>
            <input type="text" name="national_id" class="form-control" value="{{ $homeowner->national_id }}" required>
        </div>
        <div class="form-group">
            <label for="passport_number">Passport Number</label>
            <input type="text" name="passport_number" class="form-control" value="{{ $homeowner->passport_number }}">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male" {{ $homeowner->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $homeowner->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $homeowner->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $homeowner->address }}" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="{{ $homeowner->city }}" required>
        </div>
        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" name="profession" class="form-control" value="{{ $homeowner->profession }}" required>
        </div>
        <div class="form-group">
            <label for="marital_status">Marital Status</label>
            <input type="text" name="marital_status" class="form-control" value="{{ $homeowner->marital_status }}" required>
        </div>
        <div class="form-group">
            <label for="religion">Religion</label>
            <input type="text" name="religion" class="form-control" value="{{ $homeowner->religion }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection