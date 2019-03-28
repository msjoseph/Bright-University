<div class="modal fade" id="calendar" tabindex="-1" role="dialog" aria-labelledby="calendarTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarTitle">
                    @foreach($year as $years)
                        @foreach($semester as $semesters)
                            <small class="text-info">Year {{$years->academic_year}} Semester {{$semesters->semester}}</small>
                        @endforeach
                    @endforeach
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p><small class="text-danger">Year and Semester</small> </p>
                    @foreach($year as $years)
                        @foreach($semester as $semesters)
                            {!! Form::open(['action' => ['CalendarController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{Form::label('academic_year', 'Academic Year')}}
                                {{Form::text('academic_year', $years->academic_year, ['class' => 'form-control', 'placeholder' =>'Academic Year'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('semester', 'Semester')}}
                                {{Form::number('semester', $semesters->semester, ['min' => '1', 'max' => '2', 'class' => 'form-control', 'placeholder' =>'Semester'])}}
                            </div>
                            <input type="hidden" name="year_id" value="{{$years->id}}">
                            <input type="hidden" name="semester_id" value="{{$semesters->id}}">
                            {{Form::submit('Update', ['class'=>'btn btn-primary '])}}
                            {!! Form::close() !!}
                        @endforeach
                    @endforeach

                </div>
                <div class="container-fluid mt-1">
                    <p><small class="text-danger">Examinations</small> </p>
                    {!! Form::open(['action' => 'ExamCodesController@store', 'method' => 'POST', 'class' => 'pull-left']) !!}
                    {{Form::submit('Exam Codes', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>