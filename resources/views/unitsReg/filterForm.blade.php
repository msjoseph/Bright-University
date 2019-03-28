<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="filterModalTitle"><small>Filter units by :</small></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                {!! Form::open(['action' => ['UnitsRegController@create'], 'method' => 'POST']) !!}
                <div class="form-group mb-2">
                    {{Form::label('school_id', 'School', ['class' => 'mr-2'])}}
                    @if (count($schools) >0)
                    <select class="form-control" name="school_id" id="school_id">
                            <option value="0">---------</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>

                    @endif
                </div>
                <div class="form-group mb-2">
                    {{Form::label('course_id', 'Course', ['class' => 'mr-2 ml-2'])}}
                    @if (count($courses) >0)
                    <select class="form-control" name="course_id" id="course_id">
                            <option value="0">---------</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>

                    @endif
                </div>
                <div class="form-group mb-2">
                        {{Form::label('year', 'Year', ['class' => 'mr-2 ml-2'])}}

                        <select class="form-control" name="year" id="year">
                                <option value="0">---------</option>
                                <option value="1">Year I</option>
                                <option value="2">Year II</option>
                                <option value="3">Year III</option>
                                <option value="4">Year IV</option>
                        </select>

                </div>
                <div class="form-group mb-2">
                    {{Form::label('semester', 'Semester', ['class' => 'mr-2 ml-2'])}}

                    <select class="form-control" name="semester" id="semester">
                            <option value="0">---------</option>
                            <option value="1">Semester I</option>
                            <option value="2">Semester II</option>
                    </select>
                </div>
                <button type='submit' class="btn btn-success mx-sm-3 mb-2"><i class="fa fa-filter"></i></button>
                {!! Form::close() !!}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>



