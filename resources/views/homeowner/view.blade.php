@extends('layouts.app')

@section('main')
    

<div class="container">
    <h1 class="mb-4">Full Profile</h1>

    <div class="card">
        <div class="card-header">
            <h4>{{ $homeowner->full_name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>National ID</th>
                    <td>{{ $homeowner->national_id }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $homeowner->address }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $homeowner->city }}</td>
                </tr>
                <tr>
                    <th>Profession</th>
                    <td>{{ $homeowner->profession }}</td>
                </tr>
                <tr>
                    <th>Marital Status</th>
                    <td>{{ ucfirst($homeowner->marital_status) }}</td>
                </tr>
                <tr>
                    <th>Religion</th>
                    <td>{{ $homeowner->religion }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ ucfirst($homeowner->gender) }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        @if ($homeowner->image)
                            <img src="{{ asset('/storage/app/public/homeowners/' . $homeowner->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                        @else
                            <span>No image uploaded</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('homeowner.dashboard') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection