@extends('base')

@section('title')
    Degree Programmes
@endsection

@section('content')
    <style type="text/css">
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container-fluid border-bottom border-danger mt-2 row">
        <div class="col-lg-6">
            <h3 class="text-center text-danger">Bright Programs</h3>
        </div>
        <div class="col-lg-6">
            @if(!Auth::guest())
                @if(auth()->user()->is_admin == true)
                    <a class="btn btn-info pull-right" href="{{url('/courses/create')}}">Add Course
                        <i class="fa fa-angle-right ml-2" style="font-size: 20px"></i> </a>
                @endif
            @endif

        </div>

    </div>
    <div class="container-fluid mt-2">
        @if(count($courses)>0)
            @foreach($courses as $course)
                <div class="row border-bottom border-danger mb-2">
                    <div class="col-lg-4 mb-2">
                        <img src="/storage/courses_images/{{$course->cover_image}}" alt="{{$course->name}}">
                    </div>
                    <div class="col-lg-8 mb-2">
                        <div class="container-fluid">
                            <h3 class="text-info text-center">{{$course->name}}</h3>
                            @foreach ($schools as $school)
                                @if ($course->school_id == $school->id)
                                    <p><small class="text-info">In School of </small><small class="text-danger">{{ $school->name }}</small> </p>
                                @endif
                            @endforeach
                            <p><small class="text-info">Major KCSE subjects :</small><small class="text-danger">{{ $course->main_subjects }}</small> </p>
                            <p><small class="text-info">Cut-Point Mark :</small><small class="text-danger">{{ $course->cut_point}}</small> </p>
                            @foreach($lecturers as $lecturer)
                                @if($course->hod == $lecturer->id)
                                    <p><small class="text-info">Headed by : </small><small class="text-danger">
                                            {{ $lecturer->first_name}} {{ $lecturer->last_name}}</small> - <small>{{$lecturer->email}}</small></p>
                                @endif
                            @endforeach
                            @if(!Auth::guest())
                                @if(auth()->user()->is_admin == true)
                                    <div class="mt-1">
                                        <a class="btn btn-info pull-left" href="/courses/{{$course->id}}/edit">Update</a>
                                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete{{$course->id}}">Remove</button>
                                    </div>
                                @endif

                            @endif

                        </div>
                    </div>
                </div>


                <!--Delete Modal-->
                <div class="modal fade" id="delete{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$course->id}}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete{{$course->id}}Title"><small class="text-info">{{$course->name}}</small></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <p class="text-center"><small class="text-info">This process is irreversible</small> </p>
                                    {!! Form::open(['action' => ['CoursesController@destroy', $course->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @else
            <div class="container-fluid mt-2">
                <h3 class="text-info text-danger">No course found</h3>
            </div>
        @endif
    </div>

    {{$courses->links()}}

    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection
