@extends('layouts.app')

@section('content')

<div class=" w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            Update the Post {{$post->title}}
        </h1>
    </div>
</div>
<a href="{{url()->previous()}}" class="bg-blue-300 uppercase font-extrabold rounded-1xl py-4 px-6 text-m"> Back </a>
<br>

@if ($errors->any())
    <div class="w-4/5 m-auto">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="w-1/5 mb-4 text-gray-50 bg-red-700 py-4">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-4/5 m-auto pt-20">
    <form action="{{ url('blog/'.$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{$post->id}}" name="id">
        <input type="text" name="title" required value="{{$post->title}}" class="bg-transparent py-20 block border-b-2 w-full h-60 text-xl outline-border">
        <textarea name="description" required class=" py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-border">{{$post->description}}</textarea>
        <div class="bg-grey-lighter pt-15">
            <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
            <span class="mt-2 text-base leading-normal"> Select a file </span>
            <input type="file" class="hidden" name="image" accept=".png, .jpg, .jpeg">
        </div><br>
        <button type="submit" class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">Submit Post</button>
    </form>
</div>

@endsection
