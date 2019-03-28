@extends('base')

@section('content')
    <style type="text/css">
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container-fluid border-bottom border-danger mt-2 row">
        <div class="col-lg-6">
            <h3 class="text-center text-danger">Our Projects</h3>
        </div>
        <div class="col-lg-6">
            @if(!Auth::guest())
                @if(auth()->user()->is_admin == true)
                    <a class="btn btn-info pull-right" href="{{url('/projects/create')}}">Add Project
                        <i class="fa fa-angle-right ml-2" style="font-size: 20px"></i> </a>
                @endif
            @endif

        </div>

    </div>
    <div class="container-fluid mt-2">
        @if(count($projects)>0)
            @foreach($projects as $project)
                <div class="row border-bottom border-danger mb-2">
                    <div class="col-lg-4 mb-2">
                        <img src="/storage/projects_images/{{$project->cover_image}}" alt="{{$project->title}}">
                    </div>
                    <div class="col-lg-8 mb-2">
                        <div class="container-fluid">
                            <h3 class="text-info text-center">{{$project->name}}</h3>
                            <p ><small>{!! $project->description !!}</small></p>
                            <p class="mt-2 text-info"><small class="font-italic">Commence {{$project->commence}} Finish
                                    {{$project->finish}}</small></p>
                            @if(!Auth::guest())
                                @if(auth()->user()->is_admin == true)
                                    <div class="mt-1">
                                        <a class="btn btn-info pull-left" href="/projects/{{$project->id}}/edit">Edit</a>
                                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete{{$project->id}}">Delete</button>
                                    </div>
                                @endif

                            @endif

                        </div>
                    </div>
                </div>


                <!--Delete Modal-->
                <div class="modal fade" id="delete{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$project->id}}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete{{$project->id}}Title"><small class="text-info">{{$project->title}}</small></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <p class="text-center"><small class="text-info">This process is irreversible</small> </p>
                                    {!! Form::open(['action' => ['ProjectsController@destroy', $project->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
        @endif
    </div>

    {{$projects->links()}}

    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection
