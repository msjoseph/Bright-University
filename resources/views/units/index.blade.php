@extends('base')
@section('title')
    Course Units
@endsection

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class=" col-lg-12" >
        <div class="border-bottom border-danger container">
            <h6 class="text-center "><small class="text-info">Course Units</small></h6>
        </div>
    </div>
    <div class="container col-lg-12 mt-2" >
        <div class="pull-left">
            {{$units->links()}}
        </div>

        @if(!Auth::guest())
            @if(auth()->user()->is_admin)
                <a class="btn btn-dark pull-right" href="{{ url('/units/create') }}">Add Unit</a>
            @endif
        @endif

    </div>
    <div class="container-fluid mt-5">
    @if(count($units)>0)

                <table class="table table-striped table-light table-hover ">

                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year & Sem</th>
                    </tr>
                    @foreach($units as $unit)
                    @foreach ($courses as $course)
                        @if ($unit->course_id == $course->id)
                        <tr>
                            <td><a href="#" data-toggle="modal" data-target="#unit{{$unit->id}}">{{ $unit->code }}</a></td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $course->name }}</td>
                            <td> Year {{ $unit->year }} sem {{ $unit->semester }}</td>
                        </tr>
                        @endif

                    @endforeach
                    @endforeach


                </table>


<div class="container mt-3 ">
    {{$units->links()}}
</div>

            @if(count($units)>0)
                @foreach($units as $unit)
                    @foreach($courses as $course)
                    @if($unit->course_id == $course->id)
                    <div class="modal fade" id="unit{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalLongTitle"><small class="text-info">
                                            {{$unit->code}} : {{$unit->name}} </small>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                        <div class="container-fluid">
                                            <p><small class="text-info">{{$unit->code}} - {{$unit->name}}</small></p>
                                            <p><small class="text-info">{{$course->name}}</small></p>
                                            <p><small class="text-info">Year {{$unit->year}} Semester {{$unit->semester}}</small></p>
                                            @foreach($lecturers as $lecturer)
                                                @if($unit->lecturer_id == $lecturer->id)
                                                    <p><small class="text-info">Taken by  {{$lecturer->first_name}}
                                                             {{$lecturer->last_name}}</small></p>
                                                @endif
                                            @endforeach

                                        </div>

                                    <div class="container-fluid mt-2">
                                        <div class="pull-left">
                                            <a href="/units/{{$unit->id}}/edit" class="btn btn-primary">Modify</a>
                                        </div>
                                        <div class="pull-right">
                                            {!! Form::open(['action' => ['UnitsController@destroy', $unit->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'REMOVE')}}
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
                    @endif
                    @endforeach
                @endforeach
            @endif


    @else
        <p>No units found</p>
    @endif
</div>
    <div class="container-fluid mt-2 mb-2">
        @include('includes.footer')
    </div>

@endsection
