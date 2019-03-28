@extends('base')
@section('title')
    Units Submitting
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

            <div class="pull-right mt-2">
                <h5><small>Units basket</small><a href="#" data-toggle="modal" data-target="#unitsBasketModal"><i class="text-success fa fa-briefcase ml-3 mr-2"></i></a>
                    <small class="text-danger">{{ count($registeredUnits) }}</small></h5>


                @include('unitsReg.unitsBasketModal')


            </div>
            <div class="pull-left mt-2 mb-2">
                <a class="btn btn-primary" href="{{ url('/UnitsRegistration') }}"><i class="fa fa-angle-left" style="font-size: 20px"></i>
                    Units Registration</a>
            </div>

        </div>

        @if (count($registeredUnits)>0)
            <table class=" table table-striped " id='selectUnits'>
                <tr>
                    <th>Unit Code</th>
                    <th>Unit Name</th>
                    <th>Status</th>
                </tr>
                @foreach($registeredUnits as $registeredUnit)
                @foreach($units as $unit)
                    @if($registeredUnit->unit_id == $unit->id)
                            @if($registeredUnit->is_submitted != true)
                            <tr>
                                <td>{{ $unit->code }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>

                                    {!! Form::open(['action' => ['ExamController@store',$unit->id], 'method' => 'POST']) !!}
                                    <input type="hidden" value="{{ $unit->id }}" name="unit_id">
                                    <input type="hidden" value="{{ $unit->name }}" name="unit_name">

                                    @foreach($year as $yr)
                                        @foreach($semester as $sem)
                                            <input type="hidden" name="year" value="{{$yr->academic_year}}">
                                            <input type="hidden" name="semester" value="{{$sem->semester}}">
                                        @endforeach
                                    @endforeach

                                    {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
                                    {!! Form::close() !!}


                                </td>
                            </tr>
                                @else
                                <tr>
                                    <td>{{ $unit->code }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td><small class="text-info">Submitted</small></td>
                                </tr>
                            @endif
                        @endif
                @endforeach
                @endforeach
            </table>

        @else
            <p>Something wrong.Try again later</p>
        @endif
    @else
        <p>You are not allowed here</p>
    @endif

@endsection
