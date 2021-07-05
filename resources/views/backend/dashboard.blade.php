@extends('master')
@section('content')
    <div class="card">
        <h4>Logged in Successfully</h4>
        <div class="card">
           
            @isset($user)
                @foreach ($user->unreadNotifications as $notification) 
                <li> {{$notification->data['username']}} has registered</li>
                {{$notification->markAsRead()}} 
                @endforeach
            @endisset
           
           
                
           
            
        </div>

        <p><a href="{{route('categories.index')}}">Category</a></p>
        <p><a href="{{route('posts.index')}}">Posts</a></p>
    </div>
@endsection