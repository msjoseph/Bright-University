    @if(count($projects)>0)

        <div class="row mt-3">
            @foreach($projects as $project)

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div  >
                        <div >
                            <img class="card-img-top" src="/storage/projects_images/{{$project->cover_image}}" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$project->name}}</h5>
                            <small class="font-italic text-info">Start {{$project->commence}} finish {{$project->finish}}</small>
                            <h6 class="card-link"><a href="/projects/{{$project->id}}" data-toggle="modal" data-target="#project{{$project->id}}">VIEW PROJECT<i class="fa fa-angle-right
                                    ml-3 mr-2" style="font-size:20px;"></i> </a>
                            </h6>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    @else
        <p>No current projects yet</p>
    @endif

    @if(count($projects)>0)
        @foreach($projects as $project)
            <div class="modal fade" id="project{{$project->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{$project->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <img class="card-img-top" src="/storage/projects_images/{{$project->cover_image}}" alt="Card image cap">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h1 class="text-info text-center border-bottom border-danger"><small>{{$project->name}}</small></h1>
                                    <p><small>{!!$project->description!!}</small></p>
                                    <p><small class="font-italic text-info">Commence date {{$project->commence}} finish date {{$project->finish}}</small></p>
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
