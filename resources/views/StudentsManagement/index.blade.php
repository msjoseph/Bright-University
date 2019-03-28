@extends('base')
@section('title')
    Bright University | Students Management
@endsection

@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
@if(auth()->user()->is_admin)

    <div class=" col-lg-12" >
        <div class="border-bottom border-danger container">
            <h6 class="text-center "><small class="text-info">Students</small></h6>
        </div>
    </div>
    <div class="container col-lg-12 mt-2" >
        <div class="pull-left">
            {{$students->links()}}
        </div>
        <!--Button to trigger adding task modal-->
        <a class="btn btn-dark pull-right" href="{{ url('/StudentsManagement/create') }}">Admit Student</a>
    </div>
    @if(count($students)>0)

        <div class="container-fluid mt-5">

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

                                <td><a href="#" data-toggle="modal" data-target="#student{{$student->id}}">{{ $student->adm_num }}</a></td>
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

        @if(count($students)>0)
            @foreach($students as $student)
                <div class="modal fade" id="student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="exampleModalLongTitle"><small class="text-info">
                                        {{$student->first_name}} {{$student->last_name}} - {{$student->adm_num}}</small>
                                    </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                <div class="container-fluid mt-2">
                                    <div class="pull-left">
                                        <a href="/StudentsManagement/{{$student->id}}/edit" class="btn btn-primary">Modify</a>
                                    </div>
                                    <div class="pull-right">
                                        {!! Form::open(['action' => ['StudentsController@destroy', $student->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif

    @else
        <p>No student found</p>
    @endif

    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
    @else
    <div class="container-fluid mt-2">
        @include('includes.accessdenied')
    </div>
@endif

@endsection
