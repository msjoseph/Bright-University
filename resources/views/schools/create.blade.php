@extends('base')

@section('title')
    New School
@endsection

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    @if(auth()->user()->is_admin == true)
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/schools') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >Add a new School</h3>
            </div>
        </div>
        {!! Form::open(['action' => 'SchoolsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' =>'Name'])}}
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
            {{Form::text('adm_start', '', ['class' => 'form-control', 'placeholder' =>'Start letters of students Adm No:eg CI for Bsc Computer Science'])}}
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