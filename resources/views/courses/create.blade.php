@extends('base')

@section('title')
    New Course
@endsection

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/courses') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >Add a new Course</h3>
            </div>
        </div>
            {!! Form::open(['action' => 'CoursesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' =>'Name'])}}
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
            <br>
            <a class="btn bg-info text-white" href="/schools/create">ADD SCHOOL FIRST
                <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a>
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
            {{Form::text('units_start', '', ['class' => 'form-control', 'placeholder' => 'Example : CCS'])}}
        </div>
        <div class="form-group">
            {{Form::label('main_subjects', 'Main KCSE Subjects')}}
            {{Form::text('main_subjects', '', ['class' => 'form-control', 'placeholder' =>'Main KCSE Subjects'])}}
        </div>
        <div class="form-group">
            {{Form::label('cut_point', 'Cut Point')}}
            {{Form::number('cut_point', '', ['class' => 'form-control', 'min' => '0', 'step' =>'any'])}}
        </div>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
