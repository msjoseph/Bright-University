@extends('pages.base')

@section('content')
@foreach ($users as $user)
                    @if ($tax->user_id == $user->id)
                        <h3 class="border-bottom border-info text-center">{{ $user->name }}</h3>
                    @endif
                @endforeach
    <div class="container" style="margin-top: 20px">
        {!! Form::open(['action' =>['TaxController@update', $tax->id], 'method' => 'POST']) !!}

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

        <div class="form-group">
            {{Form::label('basic_pay', 'Basic Pay in Ksh')}}
            {{Form::number('basic_pay',$tax->basic_pay,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('total_allowance', 'Total Allowance in Ksh')}}
            {{Form::number('total_allowance',$tax->total_allowance,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('total_deductions', 'Total Deductions in Ksh')}}
            {{Form::number('total_deductions',$tax->total_deductions,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('personal_relief', 'Personal Relief in Ksh')}}
            {{Form::number('personal_relief',$tax->personal_relief,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('pension_percent', 'Pension Percentage of Basic pay')}}
            {{Form::number('pension_percent',$tax->pension_percent,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-5'])}}
        {!! Form::close() !!}
    </div>
@endsection
