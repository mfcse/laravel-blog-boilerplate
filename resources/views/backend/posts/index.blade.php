@extends('master')
@section('content')
    <h3 class="text-center mt-4">All Posts</h3>
    @if (session()->has('message'))
            <div class="alert alert-{{session('type')}}">
                {{session('message')}}
            </div>
                
            @endif
    <p>
        <a href="{{route('posts.create')}}" class="btn btn-info">Add Post</a>
    </p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->status === '1' ? 'Active' : 'Inactive'}}</td>
                    <td>
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">Details</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
            
        </table>
        {!! $posts->links() !!}
    
@endsection