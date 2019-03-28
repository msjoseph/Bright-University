@extends('base')
@section('title')
    Add an Hostel
@endsection

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container mt-3">
        <h3 class="text-center" >
            Add a new Hostel</h3>
        {!! Form::open(['action' => 'HostelsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' =>'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('rooms', 'Number of rooms')}}
            {{Form::number('rooms','1',['min' => '1', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('num_per_room', 'Tenants per room')}}
            {{Form::number('num_per_room','1',['min' => '1', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('rem_rooms', 'Rooms remaining')}}
            {{Form::number('rem_rooms','0',['min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('rent', 'Rent per Semester')}}
            {{Form::number('rent','0',['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('bank', 'Bank account')}}
            {{Form::text('bank', '', ['class' => 'form-control', 'placeholder' =>'Bank account', 'required'])}}
        </div>

        <div class="form-group">
            {{Form::label('image', 'Hostel Image')}}<br>
            {{Form::file('image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-3'])}}
        {!! Form::close() !!}
    </div>
@endsection