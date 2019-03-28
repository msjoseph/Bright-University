@extends('base')
@section('title')
    Units Registration
@endsection
@section('content')
    <div class="sticky-top mt-2">
        @include('includes.navbar')
    </div>
    @if(Auth::user()->is_student == true)
        @foreach ($student as $student)
            @foreach ($courses as $course)
                @if ($student->course_id == $course->id)
                    @if (Auth::user()->id == $student->user_id)
                        <h5 class="text-center">{{ $student->first_name }} {{ $student->last_name }} - {{ $course->name }}
                            Year II Semester II 2019/2020 academic year</h5>
                    @endif
                @endif

            @endforeach
        @endforeach

        <div class="container-fluid ">

            <div class="pull-left mt-2">
                <h5><small>Units basket</small><a href="#" data-toggle="modal" data-target="#unitsBasketModal"><i class="text-success fa fa-briefcase ml-3 mr-2"></i></a>
                    <small class="text-danger">{{ count($registeredUnits) }}</small></h5>


                @include('unitsReg.unitsBasketModal')


            </div>
            <div class="pull-right mt-2 mb-2">
                <a href="{{ url('/UnitsSubmission/create') }}" class="btn btn-primary">Submit<i class="fa fa-angle-right ml-2"
                                                                                         style="font-size: 20px"></i> </a>
            </div>

        </div>

        @if (count($units)>0)
            <table class=" table table-striped " id='selectUnits'>
                <tr>
                    <th>Unit Code</th>
                    <th>Unit Name</th>
                    <th>Course Under</th>
                    <th>Year & Semester</th>
                    <th>Action</th>
                </tr>
                @foreach($units as $unit)
                    @foreach ($courses as $course)
                        @if ($unit->course_id == $course->id)
                            <tr>
                                <td>{{ $unit->code }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>{{ $course->name }}</td>
                                <td> Year {{ $unit->year }} sem {{ $unit->semester }}</td>
                                <td>
                                    @if($student->credit <= $student->debit)
                                    {!! Form::open(['action' => 'UnitsRegistrationController@store', 'method' => 'POST']) !!}
                                    <input type="hidden" value="{{ $unit->id }}" name="unit_id">
                                    <input type="hidden" value="{{ $unit->name }}" name="unit_name">

                                    @foreach($year as $yr)
                                        @foreach($semester as $sem)
                                            <input type="hidden" name="year" value="{{$yr->academic_year}}">
                                            <input type="hidden" name="semester" value="{{$sem->semester}}">
                                        @endforeach
                                    @endforeach

                                    {{Form::submit('Register', ['class' => 'btn btn-primary'])}}
                                    {!! Form::close() !!}
                                        @else
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#payfee">Register</button>
                                    @endif
                                <div class="modal fade" id="payfee" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"><small class="text-info">Outstanding Fee</small></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <h6 class="text-center"><small class="text-danger">
                                                            Sorry you have an outstanding fee balance</small></h6>
                                                    <h6 class="text-center"><small class="text-info">Ksh.{{$student->debit}} - Debit</small> </h6>
                                                    <h6 class="text-center"><small class="text-info">Ksh.{{$student->credit}} - Credit</small> </h6>
                                                    <h6 class="text-center"><small class="text-info">Ksh.{{$student->credit - $student->debit}} - To be paid</small> </h6>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>

        @else
            <p>Something wrong.Try again later</p>
        @endif
    @else
        <div class="container-fluid mt-3">
            @include('includes.accessdenied')
        </div>
    @endif

@endsection
