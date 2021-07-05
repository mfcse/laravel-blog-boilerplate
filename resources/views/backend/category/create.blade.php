@extends('master')

@section('content')
<h4 class="text-center mt-4">Add Category</h4>
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
            <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name')}}">
                    
                  </div>
                <div class="form-group">
                  <select name="status" id="status" class="form-control">
                      <option value="1">Active</option>
                      status">
                      <option value="0">Inctive</option>
                  </select> 
                </div>
                
                <button type="submit" class="btn btn-success mr-4">Save Category</button>
                
                    <a href="{{route('categories.index')}}" class="btn btn-primary btn-info">Back to Category List</a>
                
              </form>
        
              
        </div>
    </div>
</div>

@endsection
 
    