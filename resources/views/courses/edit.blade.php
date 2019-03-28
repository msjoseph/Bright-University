@extends('base')

@section('title')
    {{$course->name}}
@endsection

@section('content')
    <div class="container-fluid mt-2 sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container mt-2 border-bottom border-danger">
        <a class="btn btn-info pull-left" href="/courses"><i class="fa fa-angle-left mr-2" style="font-size: 20px"></i> Cancel</a>
        <h3 class="text-danger text-center">{{$course->name}}</h3>
    </div>
    <div class="container" style="margin-top: 20px">
        {!! Form::open(['action' => ['CoursesController@update', $course->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $course->name, ['class' => 'form-control', 'placeholder' =>'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('school_id', 'School')}}
            @if (count($schools) >0)
                <select class="form-control" name="school_id" id="school_id">
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            @else
                <small class="text-danger">No lecturer found</small>
            @endif

        </div>
        <div class="form-group">
            {{Form::label('hod', 'Head of Department')}}
            @if (count($lecturers) >0)
                <select class="form-control" name="hod" id="hod">
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
            {{Form::label('units_start', 'Units Start')}}
            {{Form::text('units_start', $course->units_start, ['class' => 'form-control', 'placeholder' => 'Example : CCS'])}}
        </div>
        <div class="form-group">
            {{Form::label('main_subjects', 'Main KCSE Subjects')}}
            {{Form::text('main_subjects', $course->main_subjects, ['class' => 'form-control', 'placeholder' =>'Main KCSE Subjects'])}}
        </div>
        <div class="form-group">
            {{Form::label('cut_point', 'Cut Point')}}
            {{Form::number('cut_point', $course->cut_point, ['class' => 'form-control', 'min' => '0', 'step' =>'any'])}}
        </div>
            {{Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
            {{Form::submit('Update', ['class'=>'btn btn-primary mb-5'])}}
            {!! Form::close() !!}
    </div>
@endsection