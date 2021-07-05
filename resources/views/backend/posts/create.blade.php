@extends('master')

@section('content')
<h4 class="text-center mt-4">Add Post</h4>
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
            <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Post Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Post Title">
                    
                  </div>
                  <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="10" class="form-control"></textarea>
                    
                  </div>
                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>                    
                  </div>

                <div class="form-group">
                  <select name="status" id="status" class="form-control">
                      <option value="1">Active</option>
                      status">
                      <option value="0">Inctive</option>
                  </select> 
                </div>
                
                <button type="submit" class="btn btn-success mr-4">Save Post</button>
                
                    <a href="{{route('posts.index')}}" class="btn btn-primary btn-info">Back to Post List</a>
                
              </form>
        
              
        </div>
    </div>
</div>

@endsection
 
    