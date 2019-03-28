@extends('pages.base')

@section('content')
    <div class="container" style="margin-top: 20px">
        <h3 class="text-center" style="font-family: 'Tangerine', serif;font-size: 48px;text-shadow: 4px 4px 4px #aaa;">
            Add Record</h3>
        {!! Form::open(['action' => 'TaxController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <div class="form-group">
                {{Form::label('user_id', 'Tax User')}}
                @if (count($users) >0)
                <select class="form-control" name="user_id" id="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @else
                <br>
                <a class="btn bg-info text-white" href="#">ADD USER FIRST
                    <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a>
                @endif

            </div>
        </div>
        <div class="form-group">
            {{Form::label('basic_pay', 'Basic Pay')}}
            {{Form::number('basic_pay','0',['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('total_allowance', 'Total Allowance')}}
            {{Form::number('total_allowance','0',['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('total_deductions', 'Total Deductions')}}
            {{Form::number('total_deductions','0',['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('personal_relief', 'Personal Relief')}}
            {{Form::number('personal_relief','0',['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('pension_percent', 'Pension Percentage of Basic pay')}}
            {{Form::number('pension_percent','0',['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
