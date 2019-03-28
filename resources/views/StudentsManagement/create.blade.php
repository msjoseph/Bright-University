@extends('base')

@section('title')
    Admit Student
@endsection
@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/StudentsManagement') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >Admit a new Student</h3>
            </div>
        </div>
        {!! Form::open(['action' => 'StudentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name')}}
            {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' =>'First Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name')}}
            {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' =>'Last Name'])}}
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
                <a class="btn bg-info text-white" href="/schools/create">ADD COURSE FIRST
                    <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a>
            @endif

        </div>
        <div class="form-group">
            {{Form::label('government_sponsored', 'Government Sponsored')}}
            <select class="form-control" name="government_sponsored" id="government_sponsored">
                <option value="-----">------</option>
                <option value="True">True</option>
                <option value="False">False</option>
            </select>
        </div>
        <div class="form-group">
            {{Form::label('nationality', 'Nationality')}}
            <select class="form-control" name="nationality" id="nationality">
                <option value="Kenya">Kenya</option>
                <option value="Uganda">Uganda</option>
                <option value="Tanzania">Tanzania</option>
            </select>
        </div>
        <div class="form-group">
            {{Form::label('email', 'Primary Email')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' =>'Primary Email ie Your email'])}}
        </div>
        <div class="form-group">
            {{Form::label('secondary_email', 'Secondary Email')}}
            {{Form::email('secondary_email', '', ['class' => 'form-control', 'placeholder' =>'Secondary Email ie Parent/gurdian/sponsore email'])}}
        </div>
        <div class="form-group">
            {{Form::label('primary_phone', 'Primary Phone')}}
            {{Form::text('primary_phone', '', ['class' => 'form-control', 'placeholder' =>'Primary phone ie Your phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('secondary_phone', 'Secondary Phone')}}
            {{Form::text('secondary_phone', '', ['class' => 'form-control', 'placeholder' =>'Secondary Phone ie Parent/gurdian/sponsore phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('postal_address', 'Postal Address')}}
            {{Form::text('postal_address', '', ['class' => 'form-control', 'placeholder' =>'Postal Address'])}}
        </div>
        <div class="form-group">
            {{Form::label('profile_picture', 'Profile Picture')}}<br>
            {{Form::file('profile_picture')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
