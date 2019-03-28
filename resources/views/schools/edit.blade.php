@extends('base')
@section('title')
    School of {{$school->name}}
@endsection

@section('content')
    <div class="container-fluid mt-2 sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container mt-2 border-bottom border-danger">
        <a class="btn btn-info pull-left" href="/schools"><i class="fa fa-angle-left mr-2" style="font-size: 20px"></i> Cancel</a>
        <h3 class="text-danger text-center">{{$school->name}}</h3>
    </div>
    <div class="container" style="margin-top: 20px">
        {!! Form::open(['action' => ['SchoolsController@update', $school->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $school->name, ['class' => 'form-control', 'placeholder' =>'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('dean', 'Dean')}}
            @if (count($lecturers) >0)
                <select class="form-control" name="dean" id="dean">
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}">{{ $lecturer->first_name }} {{ $lecturer->last_name }} -
                            {{ $lecturer->reg_num }}</option>
                    @endforeach
                </select>
            @else
                <small class="text-danger">No lecturer found</small>
            @endif
        </div>
        <div class="form-group">
            {{Form::label('adm_start', 'Admission Start')}}
            {{Form::text('adm_start', $school->adm_start, ['class' => 'form-control', 'placeholder' =>'Start letters of students Adm No:eg CI for Bsc Computer Science'])}}
        </div>
            {{Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
            {!! Form::close() !!}
    </div>
@endsection