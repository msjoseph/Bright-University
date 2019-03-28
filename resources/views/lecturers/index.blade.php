@extends('base')
@section('title')
    Bright University | Lecturers
@endsection

@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
@if(auth()->user()->is_admin)
    <div class=" col-lg-12" >
        <div class="border-bottom border-danger container">
            <h6 class="text-center "><small class="text-info">Bright University Lecturers</small></h6>
        </div>
    </div>
    <div class="container col-lg-12 mt-2" >
        <div class="pull-left">
            {{$lecturers->links()}}
        </div>
        <!--Button to trigger adding task modal-->
        <a class="btn btn-dark pull-right" href="{{ url('/lecturers/create') }}">Add Lecturer</a>
    </div>
    <div  class="container-fluid">
    @if(count($lecturers)>0)

        <div class="container-fluid mt-5">

            <table class="table  table-light table-hover ">

                <tr >
                    <th>Reg No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Employer</th>
                    <th>School</th>

                </tr>
                @foreach($lecturers as $lecturer)
                    @foreach ($schools as $school)
                        @if ($lecturer->school_id == $school->id)
                            <tr>

                                <td><a href="#" data-toggle="modal" data-target="#lecturer{{$lecturer->id}}">{{ $lecturer->reg_num }}</a></td>
                                <td>{{ $lecturer->first_name }}</td>
                                <td>{{ $lecturer->last_name }}</td>
                                <td>
                                    @if($lecturer->is_government == true)
                                        Government
                                    @else
                                        University
                                    @endif
                                </td>
                                <td>{{$school->name}}</td>

                            </tr>
                        @endif

                    @endforeach
                @endforeach


            </table>

        </div>

        @if(count($lecturers)>0)
            @foreach($lecturers as $lecturer)
                <div class="modal fade" id="lecturer{{$lecturer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="exampleModalLongTitle"><small class="text-info">
                                        {{$lecturer->first_name}} {{$lecturer->last_name}} - {{$lecturer->reg_num}}</small>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4 pull-left">
                                        <img class="card-img-top" src="/storage/lecturers_images/{{$lecturer->profile_picture}}"
                                             alt="Card image cap">

                                    </div>
                                    <div class="col-8 pull-right">
                                        <p><small class="text-info">
                                                {{$lecturer->first_name}} {{$lecturer->last_name}} - {{$lecturer->reg_num}}</small></p>
                                        <p><small class="text-info">{{$lecturer->email}}</small></p>
                                        <p><small class="text-info">{{$lecturer->phone}}</small></p>
                                        @foreach($schools as $school)
                                            @if($lecturer->school_id == $school->id)
                                                <p><small class="text-info">School of {{$school->name}}</small></p>
                                            @endif
                                        @endforeach
                                        @if($lecturer->is_government == true)
                                            <p><small class="text-info">Employed by Government</small></p>
                                        @else
                                            <p><small class="text-info">Employed by University</small></p>
                                        @endif

                                    </div>
                                </div>
                                <div class="container-fluid mt-2">
                                    <div class="pull-left">
                                        <a href="/lecturers/{{$lecturer->id}}/edit" class="btn btn-primary">Update</a>
                                    </div>
                                    <div class="pull-right">
                                        {!! Form::open(['action' => ['LecturersController@destroy', $lecturer->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                        {{Form::hidden('_method', 'delete')}}
                                        {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
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
        <div class="container-fluid mt-2">
            <h3 class="text-center">No lecturer found</h3>
        </div>

    @endif


    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
    </div>
    @else
    <div class="container-fluid mt-2">
        @include('includes.accessdenied')
    </div>
@endif

@endsection
