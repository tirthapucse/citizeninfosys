@extends('layouts.app')

@section('main')

@include('layouts.message')
<div class="container">
    <h1>Create Property</h1>

    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="building_image">Building Image</label>
            <input type="file" name="building_image" id="building_image" class="form-control">
        </div>

        <div class="form-group">
            <label for="holding_number">Holding Number</label>
            <input type="text" name="holding_number" id="holding_number" class="form-control">
        </div>

        <div class="form-group">
            <label for="holding_tax_number">Holding Tax Number</label>
            <input type="text" name="holding_tax_number" id="holding_tax_number" class="form-control">
        </div>

        <div class="form-group">
            <label for="google_map_link">Google Map Link</label>
            <input type="url" name="google_map_link" id="google_map_link" class="form-control">
        </div>

        <div class="form-group">
            <label for="total_flat">Total Flat</label>
            <input type="text" name="total_flat" id="total_flat" class="form-control">
        </div>

        <div class="form-group">
            <label for="total_floor">Total Floor</label>
            <input type="text" name="total_floor" id="total_floor" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Property</button>
    </form>
</div>
@endsection
