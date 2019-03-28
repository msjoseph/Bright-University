@extends('base')

@section('title')
    Editing | {{$student->adm_num}}
@endsection

@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container mt-2 border-bottom border-danger">
        <a class="btn btn-info pull-left" href="{{url('/StudentsManagement')}}"><i class="fa fa-angle-left mr-2"></i> Cancel</a>
        <h3 class="text-danger text-center">{{$student->adm_num}}</h3>
    </div>
    <div class="container justify-content-center" style="margin-top: 20px">
        {!! Form::open(['action' => ['StudentsController@update', $student->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name')}}
            {{Form::text('first_name', $student->first_name, ['class' => 'form-control', 'placeholder' =>'First Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name')}}
            {{Form::text('last_name', $student->last_name, ['class' => 'form-control', 'placeholder' =>'Last Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('semester', 'Semester')}}
            {{Form::number('semester', $student->semester, ['min' => '1', 'max' => '2', 'class' => 'form-control', 'placeholder' =>'Semester'])}}
        </div>
        <div class="form-group">
            {{Form::label('year', 'Year')}}
            {{Form::number('year', $student->year, ['min' => '1', 'max' => '4', 'class' => 'form-control', 'placeholder' =>'Semester'])}}
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
            {{Form::email('email', $student->email, ['class' => 'form-control', 'placeholder' =>'Primary Email ie Your email'])}}
        </div>
        <div class="form-group">
            {{Form::label('secondary_email', 'Secondary Email')}}
            {{Form::email('secondary_email', $student->secondary_email, ['class' => 'form-control', 'placeholder' =>'Secondary Email ie Parent/gurdian/sponsore email'])}}
        </div>
        <div class="form-group">
            {{Form::label('primary_phone', 'Primary Phone')}}
            {{Form::text('primary_phone', $student->primary_phone, ['class' => 'form-control', 'placeholder' =>'Primary phone ie Your phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('secondary_phone', 'Secondary Phone')}}
            {{Form::text('secondary_phone', $student->secondary_phone, ['class' => 'form-control', 'placeholder' =>'Secondary Phone ie Parent/gurdian/sponsore phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('postal_address', 'Postal Address')}}
            {{Form::text('postal_address', $student->postal_address, ['class' => 'form-control', 'placeholder' =>'Postal Address'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            @if($student->profile_picture == 'noimage.jpg')
                {{Form::label('profile_picture', 'Profile Picture not set')}}<br>
                @else
                {{Form::label('profile_picture', 'Profile Picture set')}}<br>
            @endif

            {{Form::file('profile_picture')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
