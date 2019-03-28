@extends('base')
@section('title')
    Lecturers | Add
@endsection

@section('content')
    <div class="sticky-top ">
        @include('includes.navbar')
    </div>
    <div class="container" style="margin-top: 20px">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <p class="pull-left"><a class="btn bg-info text-white" href="{{ url('/lecturers') }}">
                        <i class="fa fa-angle-left " style="font-size:20px;"></i> Back </a> </p>
            </div>
            <div class="col-lg-6 mt-2">
                <h3 class="pull-right" >Add a new Lecturer</h3>
            </div>
        </div>
        {!! Form::open(['action' => 'LecturersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name')}}
            {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' =>'First Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name')}}
            {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' =>'Last Name'])}}
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
            {{Form::label('is_government', 'Employer')}}
            <select class="form-control" name="is_government" id="is_government">
                <option value="-----">------</option>
                <option value="True">Government</option>
                <option value="False">University</option>
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
            {{Form::label('email', 'Email')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' =>'Email Address'])}}
        </div>
        <div class="form-group">
            {{Form::label('phone', 'Phone')}}
            {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' =>'Phone Number'])}}
        </div>
        <div class="form-group">
            {{Form::label('profile_picture', 'Profile Picture')}}<br>
            {{Form::file('profile_picture')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
