@extends('base')
@section('title')
    EaTube
@endsection
@section('content')
    <style type="text/css">
        video{
            max-width: 100%;
            height: auto;
        }
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="sticky-top">
        @include('EaTube.includes.navbar')
    </div>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                @if(count($files)>0)
                    <video class="card-img-top" src="/storage/EaTube/{{$current_file}}" controls
                           loop poster="{{ asset('images/videos.png') }}">{{$current_file}}</video>
                    <p class="text-center"><small class="text-info">{{$current_file}}</small></p>
                    <div class="container-fluid">
                        <button class="btn btn-success " data-toggle="modal" data-target="#comment">Comment</button>
                    </div>
                    @include('EaTube.includes.comment')
                    <div class="container-fluid mt-1">
                        @foreach($files as $file)
                            @if($file->file == $current_file)
                                @foreach($comments as $comment)
                                    @if($comment->video_id == $file->id)
                                        @foreach($users as $user)
                                            @if($user->id == $comment->user_id)
                                                <p class="text-info">{{$user->email}} : <small style="color: #000000">{{$comment->comment}}</small></p>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                @else
                    <h3 class="text-center"><small class="text-info">No files yet</small></h3>
                @endif

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                @if(count($files)>0)
                    @foreach($files as $file)
                        <hr>
                        <p class="text-center text-success">
                            <i class="fa fa-play" style="font-size: 50px"></i>
                        </p>
                        <div class="row mt-1">
                            <div class="col-10">
                                <span><small class="text-info">{{$file->file}}</small> </span>
                            </div>
                            <div class="col-2">
                                {!! Form::open(['action' => 'EaTubeController@store', 'method' => 'post', 'class' => 'pull-right']) !!}
                                <input type="hidden" value="{{$file->file}}" name="file">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-play  text-white "></i></button>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection