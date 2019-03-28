@extends('base')

@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container-fluid mt-2 border-bottom border-danger row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <a class="btn btn-info float-lg-left " href="/news"><i class="fa fa-angle-left mr-1"></i> Cancel</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h3 class="text-danger float-lg-right">{{$post->title}}</h3>
        </div>
    </div>
    <div class="container border-bottom border-danger mt-2 mb-2">
        {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' =>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' =>'Body text'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-2'])}}
        {!! Form::close() !!}

    </div>

@endsection