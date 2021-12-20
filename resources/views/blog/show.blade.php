@extends('layouts.app')

@section('content')

<a href="{{url()->previous()}}" class="bg-blue-300 uppercase font-extrabold rounded-1xl py-4 px-6 text-m"> Back </a>

<div class=" w-4/5 m-auto text-left">
    <img src="{{asset('images/' . $post->image_path) }}" class="rounded-full h-24 w-24 flex items-center md:float-center"/> <br>
    <div class="py-15">
        <h1 class="text-6xl">
             {{$post->title}}
        </h1>
        
    </div>
</div>

<br>


<div class="w-4/5 m-auto pt-20">
    <span class="text-gray-500"> 
        By<span class="font-bold italic text-gray-800"> {{$post->user->name}} </span> {{date('jS M Y', strtotime($post->updated_at)) }}
    </span>
    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light"> {{$post->description}}</p>
    <span class="font-bold italic text-gray-500 text-sm">
        {{ $post->likes->count()}} {{Str::plural('like', $post->likes->count())  }}
    </span>
</div>

@endsection
