@extends('layouts.app')

@section('main')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white">
                            Tenant Area           
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('uploads/profile/' . Auth::user()->tenant->image) }}" class="img-fluid rounded-circle" alt="{{ Auth::user()->name }}">                            
                            </div>
                            <div class="h5 text-center">
                                @if(Auth::user()->role === 'tenant')
                                    <div class="h5 text-center">
                                        <strong>{{ Auth::user()->tenant->full_name }}</strong>
                                        <p class="h6 mt-2 text-muted">Tenant</p>
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
                                    <a href="#">My Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="#">View Profile</a>                               
                                </li>
                                <li class="nav-item">
                                    <a href="#">Logout</a>
                                </li>                           
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    
                    @include('layouts.message')

                    <div class="card border-0 shadow">
                        <div class="card-header text-white">
                            Profile Update
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tenant.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                        
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', Auth::user()->tenant->full_name ?? '') }}" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="image" class="form-label">Profile Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                        
                                <div class="mb-3">
                                    <label for="national_id" class="form-label">National ID</label>
                                    <input type="text" name="national_id" id="national_id" class="form-control" value="{{ old('national_id', Auth::user()->tenant->national_id ?? '') }}" maxlength="10">
                                </div>
                        
                                <div class="mb-3">
                                    <label for="nid_front_image" class="form-label">NID Front Image</label>
                                    <input type="file" name="nid_front_image" id="nid_front_image" class="form-control">
                                </div>
                        
                                <div class="mb-3">
                                    <label for="nid_back_image" class="form-label">NID Back Image</label>
                                    <input type="file" name="nid_back_image" id="nid_back_image" class="form-control">
                                </div>
                        
                                <div class="mb-3">
                                    <label for="passport_number" class="form-label">Passport Number</label>
                                    <input type="text" name="passport_number" id="passport_number" class="form-control" value="{{ old('passport_number', Auth::user()->tenant->passport_number ?? '') }}">
                                </div>
                        
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male" {{ old('gender', Auth::user()->tenant->gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', Auth::user()->tenant->gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', Auth::user()->tenant->gender ?? '') === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', Auth::user()->tenant->address ?? '') }}" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', Auth::user()->tenant->city ?? '') }}" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="profession" class="form-label">Profession</label>
                                    <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession', Auth::user()->tenant->profession ?? '') }}" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="marital_status" class="form-label">Marital Status</label>
                                    <input type="text" name="marital_status" id="marital_status" class="form-control" value="{{ old('marital_status', Auth::user()->tenant->marital_status ?? '') }}" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" name="religion" id="religion" class="form-control" value="{{ old('religion', Auth::user()->tenant->religion ?? '') }}" required>
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>          
                        </div>
                    </div>                
                </div>
            </div>       
        </div>
    </section>
@endsection
