@extends('layouts.app')

@section('content')

<div class=" w-4/5 m-auto text-center">
    <div class="py-16 border-b border-gray-200">
        <h1 class="text-6xl">
            Blog Posts
        </h1>
    </div>
</div>

@if (session()->has('message')) 
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-1/6 mb-4 text-gray-50 bg-green-500 rounded-1xl py-4"> {{session()->get('message')}} </p>
    </div>
@endif

<div class="pt-15 <-4/5 m-auto"> 
    <a href="{{url()->previous()}}" class="bg-blue-300 uppercase font-extrabold rounded-1xl py-3 px-4 text-s"> Back </a>
</div> <br>

@if (Auth::check())
    <div class="pt-15 <-4/5 m-auto"> 
        <a href="{{ URL::temporarySignedRoute('posts.create', now()->addMinutes(30)) }}" class="bg-blue-500 uppercase bg-transparent test-gray-100 text-xs font-extrabold py-3 px-5 "> Create a Post </a>
    </div>
@endif
<br>
@foreach ($posts as $post)
    <br>
    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            @if ($post->image_path)
                <img src="{{asset('images/' . $post->image_path) }}" width="600" alt="post_image"/>
            @else
                <img src="{{asset('images/df.jpg')}}" width="600" alt="post_default_image"/>
            @endif

            
        </div>

        <div>
            <h2 class="text-gray-700 font-bold text-5xl pb-4"> {{$post->title}} </h2>
            <span class="text-gray-700"> 
                By <span class="font-bold italic text-gray-700"> {{$post->user->name}}  {{date('jS M Y', strtotime($post->updated_at)) }} </span> 
            </span>

            <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light"> {{$post->description}} </p>

            <a href="{{ URL::temporarySignedRoute('posts.show', now()->addMinutes(30), ['id' => $post->id]) }}" class="bg-blue-500 uppercase font-extrabold rounded-3xl py-4 px-8 text-lg"> Keep Reading</a>

            <div class="w-4/5 m-auto pt-20 text-center">
                @if (!$post->likedBy(auth()->user() ))
                    <form action="{{ route('posts.likes', $post->id) }}" method="POST" >
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-500 uppercase font-extrabold rounded-3xl py-4 px-8 text-m">Like</button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post->id) }}" method="POST"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-500 uppercase font-extrabold rounded-3xl py-4 px-8 text-m">UnLike</button>
                    </form>
                @endif
                
                
                <span>{{$post->likes->count()}} {{Str::plural('like', $post->likes->count()) }}</span>
            </div>


            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user->id)
                <span class="float-right">
                    <a href="{{ URL::temporarySignedRoute('posts.edit', now()->addMinutes(30), ['id' => $post->id]) }}" class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit</a> 
                    
                </span>
                <span class="float-right">
                    <form method="POST" action="/blog/{{$post->id}}">
                        @csrf
                        @method('delete')
                        <button class="text-red-500 pr-3" type="submit">Delete</button>
                    </form>
                </span>
            @endif
        </div>
    </div>
@endforeach
@endsection
