@extends('base')
@section('title')
    Marks Submission
@endsection

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class=" col-lg-12 mt-2" >
        <div class="border-bottom border-danger container">
            @if(auth()->user()->is_lecturer == true)

                    @foreach($lecturers as $lecturer)
                        @if(auth()->user()->lecturer_key == $lecturer->user_key)
                            @foreach($schools as $school)
                                @if($lecturer->school_id == $school->id)
                                <h6 class="text-center "><small class="text-info">{{$lecturer->first_name}}
                                        {{$lecturer->last_name}}- {{$lecturer->reg_num}} in school of {{$school->name}}
                                    <i class="fa fa-briefcase ml-5  text-white btn btn-danger" data-toggle="modal"
                                       data-target="#unitsModal" style="font-size: 20px"></i> </small></h6>

                                @endif
                            @endforeach
                    <!--Units Modal-->
        <div class="modal fade" id="unitsModal" tabindex="-1" role="dialog" aria-labelledby="unitsModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unitsModalLongTitle"><small class="text-info">My Units</small></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @foreach($units as $unit)
                                @if($unit->lecturer_id == $lecturer->id)
                                    <h6><small>{{$unit->code}} - {{$unit->name}}</small></h6>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

                        @endif
                    @endforeach
            @endif
        </div>

    </div>

    <div class="container-fluid mt-2">
        @if(auth()->user()->is_lecturer == true)
            @foreach($lecturers as $lecturer)
                @if($lecturer->user_key == auth()->user()->lecturer_key)
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Student Adm No</th>
                            <th>Unit Code</th>
                            <th>Year and Semester</th>
                            <th>CAT Marks</th>
                            <th>Exam Marks</th>
                            <th>Submit</th>
                        </tr>

                    @foreach($units as $unit)
                        @if($unit->lecturer_id == $lecturer->id)
                            @foreach($submittedUnits as $submittedUnit)
                                @if($submittedUnit->unit_id == $unit->id)
                                    <tr>
                                        <td>
                                            @foreach($users as $user)
                                                @if($user->id == $submittedUnit->user_id)
                                                    @foreach($students as $student)
                                                        @if($student->user_key == $user->student_key)
                                                            {{$student->adm_num}}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$unit->code}}</td>
                                        <td>{{$submittedUnit->year}} Semester {{$submittedUnit->semester}}</td>
                                        {!! Form::open(['action' => ['ExamController@update', $submittedUnit->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                        <td>
                                            {{Form::number('cat', $submittedUnit->cat,['step' =>'any', 'min' => '0', 'max' => '30', 'class' => 'form-control', 'required'])}}
                                        </td>
                                        <td>
                                            {{Form::number('exam', $submittedUnit->exam,['step' =>'any', 'min' => '0', 'max' => '70', 'class' => 'form-control', 'required'])}}
                                        </td>
                                        <td>
                                            {{Form::hidden('_method', 'PUT')}}
                                            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                                        </td>
                                        {!! Form::close() !!}
                                    </tr>
                                @endif
                            @endforeach

                        @endif
                    @endforeach
                    </table>
                @endif
            @endforeach
            @else
            <div class="container-fluid mt-3">
                @include('includes.accessdenied')
            </div>
        @endif
    </div>
    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection