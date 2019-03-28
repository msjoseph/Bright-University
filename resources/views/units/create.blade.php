@extends('base')

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/units') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >Add a Unit</h3>
            </div>
        </div>
        {!! Form::open(['action' => 'UnitsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' =>'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('course_id', 'Course')}}
            @if (count($courses) >0)
            <select class="form-control" name="course_id" id="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            @else
            <br>
            <a class="btn bg-info text-white" href="/courses/create">ADD COURSE FIRST
                <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a>
            @endif
        </div>
        <div class="form-group">
            {{Form::label('year', 'Year')}}
            {{Form::number('year', '1', ['min' => '1', 'max' => '4', 'class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('semester', 'Semester')}}
            {{Form::number('semester', '1', ['min' => '1', 'max' => '2', 'class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('lecturer_id', 'Lecturer')}}
            @if (count($lecturers) >0)
                <select class="form-control" name="lecturer_id" id="lecturer_id">
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}">{{ $lecturer->first_name }} {{ $lecturer->last_name }} - {{ $lecturer->reg_num }}</option>
                    @endforeach
                </select>
            @else
                <br>
                <a class="btn bg-info text-white" href="/courses/create">ADD COURSE FIRST
                    <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a>
            @endif
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
