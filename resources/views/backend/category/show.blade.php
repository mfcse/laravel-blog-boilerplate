@extends('master')
@section('content')
<h3>Details of {{$category->name}}</h3>
<p>Name: {{$category->name}}</p>
<p>Slug: {{$category->slug}}</p>
<p>Status: {{$category->status}}</p>
<p>Created At: {{$category->created_at}}</p>
<div>
    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info">Edit Category</a>
    <hr>
    <form action="{{route('categories.destroy',$category->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Category</button>
    </form>
    <hr>
    <a href="{{route('categories.index')}}" class="btn btn-primary btn-info">Back to Category List</a>
</div>
    
@endsection