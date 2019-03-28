@extends('base')
@section('title')
    Editing | {{$lecturer->reg_num}}
@endsection
@section('content')
    <div class="sticky-top ">
        @include('includes.navbar')
    </div>
    <div class="container mt-2 border-bottom border-danger">
        <a class="btn btn-info pull-left" href="{{url('/lecturers')}}"><i class="fa fa-angle-left mr-2"></i> Cancel</a>
        <h3 class="text-danger text-center">{{$lecturer->reg_num}}</h3>
    </div>
    <div class="container mt-2">
        <div class="justify-content-center">
            {!! Form::open(['action' => ['LecturersController@update', $lecturer->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('first_name', 'First Name')}}
                {{Form::text('first_name', $lecturer->first_name, ['class' => 'form-control', 'placeholder' =>'First Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('last_name', 'Last Name')}}
                {{Form::text('last_name', $lecturer->last_name, ['class' => 'form-control', 'placeholder' =>'Last Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('school_id', 'School')}}
                @if (count($schools) >0)
                    <select class="form-control" name="school_id" id="school_id">
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
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
                {{Form::email('email', $lecturer->email, ['class' => 'form-control', 'placeholder' =>'Email Address'])}}
            </div>
            <div class="form-group">
                {{Form::label('phone', 'Phone')}}
                {{Form::text('phone', $lecturer->phone, ['class' => 'form-control', 'placeholder' =>'Phone Number'])}}
            </div>
            <div class="form-group">
                {{Form::label('profile_picture', 'Profile Picture')}}<br>
                {{Form::file('profile_picture')}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection