@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <!-- Sidebar code from your existing dashboard -->
                </div>
                <div class="col-md-9">
                    @include('layouts.message')
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
                            Edit Property
                        </div>
                        <div class="card-body">
                            <form action="{{ route('superadmin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="building_name" class="form-label">Building Name</label>
                                    <input type="text" class="form-control" id="building_name" name="building_name" value="{{ $property->building_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="building_address" class="form-label">Building Address</label>
                                    <input type="text" class="form-control" id="building_address" name="building_address" value="{{ $property->building_address }}">
                                </div>
                                <div class="mb-3">
                                    <label for="holding_number" class="form-label">Holding Number</label>
                                    <input type="text" class="form-control" id="holding_number" name="holding_number" value="{{ $property->holding_number }}">
                                </div>
                                <div class="mb-3">
                                    <label for="holding_tax_number" class="form-label">Holding Tax Number</label>
                                    <input type="text" class="form-control" id="holding_tax_number" name="holding_tax_number" value="{{ $property->holding_tax_number }}">
                                </div>
                                <div class="mb-3">
                                    <label for="google_map_link" class="form-label">Google Map Link</label>
                                    <input type="url" class="form-control" id="google_map_link" name="google_map_link" value="{{ $property->google_map_link }}">
                                </div>
                                <div class="mb-3">
                                    <label for="total_flat" class="form-label">Total Flats</label>
                                    <input type="text" class="form-control" id="total_flat" name="total_flat" value="{{ $property->total_flat }}">
                                </div>
                                <div class="mb-3">
                                    <label for="total_floor" class="form-label">Total Floors</label>
                                    <input type="text" class="form-control" id="total_floor" name="total_floor" value="{{ $property->total_floor }}">
                                </div>
                                <div class="mb-3">
                                    <label for="building_image" class="form-label">Building Image</label>
                                    <input type="file" class="form-control" id="building_image" name="building_image">
                                    @if($property->building_image)
                                        <img src="{{ asset('storage/' . $property->building_image) }}" alt="Building Image" class="img-thumbnail mt-2" width="100">
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Update Property</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection