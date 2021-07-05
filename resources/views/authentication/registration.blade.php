@extends('master')

@section('content')
<h1 class="text-center mt-4">Registration Form</h1>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('message'))
            <div class="alert alert-{{session('type')}}">
                {{session('message')}}
            </div>
                
            @endif
            <form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name')}}">
                    
                  </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"  value="{{old('email')}}">
                  
                </div>
                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" id="phone_number"  placeholder="Enter Phone No. "  value="{{old('phone_number')}}">
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                  </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        
        </div>
    </div>
</div>

@endsection
 
    