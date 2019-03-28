@extends('base')

@section('title')
    {{$project->name}}
@endsection
@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container-fluid mt-2 border-bottom border-danger row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <a class="btn btn-info float-lg-left " href="/projects"><i class="fa fa-angle-left mr-1"></i> Cancel</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h3 class="text-danger float-lg-right">{{$project->name}}</h3>
        </div>
    </div>
<div class="container">
    {!! Form::open(['action' => ['ProjectsController@update', $project->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $project->name, ['class' => 'form-control', 'placeholder' =>'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $project->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' =>'Project description'])}}
    </div>
    <div class="form-group">
        {{Form::label('commence', 'Commencing date',['class' => 'mr-3'])}}
        {{Form::date('commence', $project->commence)}}
    </div>
    <div class="form-group">
        {{Form::label('finish', 'Finishing date',['class' => 'mr-3'])}}
        {{Form::date('finish', $project->finish)}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection