
<div class=" col-lg-12" >
    <div class="border-bottom border-danger container">
        <h6 class="text-center "><small class="text-info">Students</small></h6>
    </div>
</div>
<div class="container col-lg-12 mt-2" >
    <!--Button to trigger adding task modal-->
    <a class="btn btn-dark pull-right" href="{{ url('/StudentsManagement/create') }}">Add Student</a>
</div>
@if(count($students)>0)

    <div class="container-fluid mt-2">

        <table class="table  table-light table-hover ">

            <tr >
                <th>Reg No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sponsored</th>
                <th>Currently</th>

            </tr>
            @foreach($students as $student)
                @foreach ($courses as $course)
                    @if ($student->course_id == $course->id)
                        <tr>

                            <td>{{ $student->adm_num }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>
                                @if($student->government_sponsored == true)
                                    Yes
                                    @else
                                    No
                                @endif
                            </td>
                            <td>Year {{$student->year}} Sem {{$student->semester}}</td>

                        </tr>
                    @endif

                @endforeach
            @endforeach


        </table>

    </div>
    <div class="container mt-3 ">
        {{$students->links()}}
    </div>


@else
    <p>No student found</p>
@endif
