@extends('pages.base')
@section('title')
    News - {{$post->title}}
@endsection
@section('content')

<div class="container-fluid mt-4">
    <div class="row container mb-2">
        <div >
            <a href="/posts" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
            <h3><small class="card-text">Rate this post<i class="btn bg-success text-white fa fa-thumbs-up ml-3 mr-3"
               style="font-size:20px;"></i>200<i class="btn bg-danger text-white fa fa-thumbs-down ml-3 mr-3"
                                                 style="font-size:20px;"></i>50</small></h3>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12">
            <h1>{{$post->title}}</h1>
            <p>{!!$post->body!!}</p>
            <p><small class="font-italic text-info">Posted on {{$post->created_at}} by {{$post->user->name}}</small></p>

            @if(!Auth::guest())
                @if(Auth::user()->id == $post->user_id)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>

                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
    </div>
</div>

@endsection