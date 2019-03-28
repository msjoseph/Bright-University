@extends('base')

@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/news') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >
                    Create a new post</h3>
            </div>
        </div>

        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' =>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' =>'Body text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection