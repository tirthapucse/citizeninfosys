@extends('layouts.app')

@section('main')
<section>
<div class="container">
<div class="row my-5">    
<div class="col-md-9">
    <div class="card border-0 shadow">
        <div class="card-header  text-white">
            Profile
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="John Doe" class="form-control" placeholder="Name" name="name" id="" />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="text" value="john@example.com" class="form-control" placeholder="Email"  name="email" id="email"/>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <img src="images/profile-img-1.jpg" class="img-fluid mt-4" alt="Luna John" >
            </div>   
            <button class="btn btn-primary mt-2">Update</button>                     
        </div>
    </div>                
</div>
</div>
</div>
</section>
@endsection