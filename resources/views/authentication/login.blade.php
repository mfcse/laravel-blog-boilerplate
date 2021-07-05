@extends('master')
@section('content')
<h1 class="text-center">Login</h1>
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
            <form method="POST" action="{{route('login')}}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"  value="{{old('email')}}">
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        
        </div>
    </div>
</div>
@endsection
   

    