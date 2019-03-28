@extends('base')

@section('title')
    New Project
@endsection

@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    @if(auth()->user()->is_admin == true)
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/projects') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >New Project</h3>
            </div>
        </div>

        {!! Form::open(['action' => 'ProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' =>'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' =>'Description text'])}}
        </div>
        <div class="form-group">
            <label for="commence" class="mr-3">Begin</label>
            <input name="commence" type="date" id="commence" class="form-control">
        </div>

        <div class="form-group">
            <label for="finish" class="mr-3">Finish</label>
            <input name="finish" type="date" id="finish" class="form-control">
        </div>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
        @else
        <div class="container-fluid mt-3">
            @include('includes.accessdenied')
        </div>
    @endif

@endsection