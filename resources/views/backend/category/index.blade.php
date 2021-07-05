@extends('master')
@section('content')
    <h3 class="text-center mt-4">Category List</h3>
    @if (session()->has('message'))
            <div class="alert alert-{{session('type')}}">
                {{session('message')}}
            </div>
                
            @endif
    <p>
        <a href="{{route('categories.create')}}" class="btn btn-info">Add Category</a>
    </p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>{{$category->status===1 ? 'Active' : 'Inactive'}}</td>
                    <td>
                        <a href="{{route('categories.show',$category->id)}}" class="btn btn-info">Details</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
            {{-- {!! $categories->links() !!} --}}
        </table>
        
    
@endsection