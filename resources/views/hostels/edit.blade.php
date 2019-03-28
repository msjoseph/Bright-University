@extends('base')
    @section('title')
        {{$hostel->name}} Hostel
    @endsection
@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container mt-2">
        <h3 class="text-center text-danger">
            {{$hostel->name}} Hostel</h3>
        {!! Form::open(['action' => ['HostelsController@update', $hostel->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $hostel->name, ['class' => 'form-control', 'placeholder' =>'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('rooms', 'Number of rooms')}}
            {{Form::number('rooms', $hostel->rooms,['min' => '1', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('num_per_room', 'Tenants per room')}}
            {{Form::number('num_per_room', $hostel->num_per_room,['min' => '1', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('rem_rooms', 'Rooms remaining')}}
            {{Form::number('rem_rooms', $hostel->rem_rooms,['min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('rent', 'Rent per Semester in Ksh')}}
            {{Form::number('rent', $hostel->rent,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('bank', 'Bank account')}}
            {{Form::text('bank', $hostel->bank, ['class' => 'form-control', 'placeholder' =>'Bank account', 'required'])}}
        </div>
            {{Form::hidden('_method', 'PUT')}}
        <div class="form-group">
            {{Form::label('image', 'Change Hostel Image')}}<br>
            {{Form::file('image')}}
        </div>
            {{Form::submit('Update', ['class'=>'btn btn-primary mb-3'])}}
            {!! Form::close() !!}
    </div>
@endsection