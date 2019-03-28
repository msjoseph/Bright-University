<div class="row">
    <div class="col-4 pull-left">
        <img class="card-img-top" src="/storage/students_images/{{$student->profile_picture}}"
             alt="Card image cap">
        @if($student->is_active == true)
            <p><small class="text-success">Active</small></p>
        @else
            <p><small class="text-danger">Inactive</small></p>
        @endif

    </div>
    <div class="col-8 pull-right">
        <p><small class="text-info">
                {{$student->first_name}} {{$student->last_name}} - {{$student->adm_num}}</small></p>
        <p><small class="text-info">{{$student->email}}</small></p>
        <p><small class="text-info">{{$student->primary_phone}}</small></p>
        <p><small class="text-info">{{$student->postal_address}}</small></p>
        <p><small class="text-info">Year {{$student->year}} Sem {{$student->semester}}</small></p>
        <p><small class="text-info">Fee paid Ksh. {{$student->debit}} </small></p>
        <p><small class="text-info">University Fee Ksh. {{$student->credit}} </small></p>
        @if($student->credit > $student->debit)
            <p><small class="text-danger">Balance Ksh. {{$student->credit - $student->debit}} </small></p>
        @endif


        @foreach($courses as $course)
            @if($student->course_id == $course->id)
                <p><small class="text-info">{{$course->name}}</small></p>
            @endif
        @endforeach
        @if($student->government_sponsored == true)
            <p><small class="text-info">Government sponsored</small></p>
        @else
            <p><small class="text-info">Parallel student</small></p>
        @endif

    </div>
</div>