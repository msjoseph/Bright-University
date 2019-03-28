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
            <h3 class="text-center text-danger">News and Updates</h3>
        </div>
        <div class="col-lg-6">
            <a class="btn btn-info pull-right" href="{{url('/news/create')}}">New Post<i class="fa fa-angle-right ml-1"></i> </a>
        </div>
    </div>
    <div class="container-fluid mt-2">
            @if(count($posts)>0)
                @foreach($posts as $post)
                    <div class="row border-bottom border-danger mb-2">
                        <div class="col-lg-4 mb-2">
                            <img src="/storage/news_images/{{$post->cover_image}}" alt="{{$post->title}}">
                        </div>
                        <div class="col-lg-8 mb-2">
                            <div class="container-fluid">
                                <h3 class="text-info text-center">{{$post->title}}</h3>
                                <p class="card-text">{!! $post->body !!}</p>
                                <p class="mt-2 text-info"><small class="font-italic">By {{$post->user->name}} on
                                        {{$post->created_at}}</small></p>
                                @if(!Auth::guest())
                                    @if(auth()->user()->id == $post->user_id)
                                <div class="mt-1">
                                    <a class="btn btn-info pull-left" href="/news/{{$post->id}}/edit">Edit</a>
                                    <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete{{$post->id}}">Delete</button>
                                </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>


                <!--Delete Modal-->
                <div class="modal fade" id="delete{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$post->id}}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete{{$post->id}}Title"><small class="text-info">{{$post->title}}</small></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <p class="text-center"><small class="text-info">This process is irreversible</small> </p>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
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

        {{$posts->links()}}

    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection
