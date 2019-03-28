@extends('base')

@section('title')
    Bright Schools
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
            <h3 class="text-center text-danger">Bright Schools</h3>
        </div>
        <div class="col-lg-6">
            @if(!Auth::guest())
                @if(auth()->user()->is_admin == true)
                    <a class="btn btn-info pull-right" href="{{url('/schools/create')}}">Add School
                        <i class="fa fa-angle-right ml-2" style="font-size: 20px"></i> </a>
                @endif
            @endif

        </div>

    </div>
    <div class="container-fluid mt-2">
        @if(count($schools)>0)
            @foreach($schools as $school)
                <div class="row border-bottom border-danger mb-2">
                    <div class="col-lg-4 mb-2">
                        <img src="/storage/schools_images/{{$school->cover_image}}" alt="{{$school->name}}">
                    </div>
                    <div class="col-lg-8 mb-2">
                        <div class="container-fluid">
                            <h3 class="text-info text-center">{{$school->name}}</h3>
                            @foreach($lecturers as $lecturer)
                                @if($school->dean == $lecturer->id)
                                    <p><small class="text-info">Headed by : </small><small class="text-danger">
                                            {{ $lecturer->first_name}} {{ $lecturer->last_name}}</small> - <small>{{$lecturer->email}}</small></p>
                                @endif
                            @endforeach
                            <div class="container-fluid">
                                <p class="text-info text-center">Courses</p>
                                <div style="width: 100%; height: 100px; background-color: #eee; overflow: scroll;">
                                    @foreach($courses as $course)
                                        @if($course->school_id == $school->id)
                                            <small>{{$course->name}}</small><br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @if(!Auth::guest())
                                @if(auth()->user()->is_admin == true)
                                    <div class="mt-1">
                                        <a class="btn btn-info pull-left" href="/schools/{{$school->id}}/edit">Update</a>
                                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete{{$school->id}}">Remove</button>
                                    </div>
                                @endif

                            @endif

                        </div>
                    </div>
                </div>


                <!--Delete Modal-->
                <div class="modal fade" id="delete{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$school->id}}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete{{$school->id}}Title"><small class="text-info">{{$school->name}}</small></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <p class="text-center"><small class="text-info">This process is irreversible</small> </p>
                                    {!! Form::open(['action' => ['SchoolsController@destroy', $school->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
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
                <h3 class="text-info text-danger">No school found</h3>
            </div>
        @endif
    </div>

    {{$schools->links()}}

    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection
