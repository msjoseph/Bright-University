@extends('base')
@section('title')
    Finance Department
@endsection

@section('content')
    <div class="sticky-top ">
        @include('includes.navbar')
    </div>
    @if(auth()->user()->is_admin == true)
    <div class="container mt-2">
        <h6 class="pull-left"><i class="fa fa-calendar mr-2  text-white btn btn-danger" data-toggle="modal"
                                  data-target="#calendar" style="font-size: 20px"></i>
            <small class="text-info">
                @foreach($year as $years)
                    @foreach($semester as $semesters)
                        <small class="text-info">{{$years->academic_year}} sem {{$semesters->semester}}</small>
                    @endforeach
                @endforeach
            </small></h6>
        <h6 class="pull-right"><i class="fa fa-briefcase mr-2  text-white btn btn-danger" data-toggle="modal"
                                 data-target="#creditfee" style="font-size: 20px"></i><small class="text-info">Credit Students Accounts</small></h6>
        <!--Calendar Modal-->
        @include('includes.yearsem')
        <!--Fee credit Modal-->
        <div class="modal fade" id="creditfee" tabindex="-1" role="dialog" aria-labelledby="creditfeeModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="creditfeeModalLongTitle"><small class="text-info">Crediting Students Accounts</small></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h6 class="text-center"><small class="text-danger">Please make sure you confirm first before making any changes</small></h6>
                            <h6 class="text-center"><small class="text-info">After this, the amount specified will be credited
                                    to all students accounts</small></h6>
                            {!! Form::open(['action' => ['FinanceController@store'], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {{Form::label('government', 'Government Students Credit Amount in Ksh')}}
                                {{Form::number('government', 0,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('parallel', 'Parallel Students Credit Amount in Ksh')}}
                                {{Form::number('parallel', 0,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
                            </div>
                            {{Form::submit('Modify', ['class' => 'btn btn-primary'])}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-2">
        <table class="table table-striped table-hover">
            <tr>
                <th>Adm Num</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Action</th>
            </tr>
            @foreach($students as $student)
                <tr>
                    <td>{{$student->adm_num}}</td>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->debit}}</td>
                    <td>{{$student->credit}}</td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#student{{$student->id}}">Modify</button></td>
                </tr>
                <div class="modal fade" id="student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="feeModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="feeModalLongTitle"><small class="text-info">{{$student->adm_num}}</small></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <h6 class="text-center"><small class="text-danger">Please make sure you confirm first before making any changes</small></h6>
                                    <h6 class="text-center"><small class="text-info">Amount specified will be accumulated to corresponding student account</small></h6>
                                    {!! Form::open(['action' => ['FinanceController@update', $student->id], 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {{Form::label('debit', 'Debit Amount in Ksh')}}
                                        {{Form::number('debit', 0,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('credit', 'Credit Amount in Ksh')}}
                                        {{Form::number('credit', 0,['step' =>'any', 'min' => '0', 'class' => 'form-control', 'required'])}}
                                    </div>
                                    {{Form::submit('Modify', ['class' => 'btn btn-primary'])}}
                                    {{Form::hidden('_method', 'PUT')}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </table>

    </div>
        @else
        <div class="container-fluid mt-3">
            @include('includes.accessdenied')
        </div>
    @endif
@endsection
