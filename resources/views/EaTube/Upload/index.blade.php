@extends('base')
@section('title')
    EaTube | Upload
@endsection
@section('content')
    <style type="text/css">
        video{
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="sticky-top">
        @include('EaTube.includes.navbar')
    </div>

    @if(count($files)>0)
        <div class="container-fluid mt-2">
            <div class="row border-bottom mb-1">
                <div class="col-lg-6">
                    <h3 class="text-center">Uploads</h3>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#upload">New Upload</button>
                </div>
            </div>
        </div>
        @foreach($files as $file)

                <div class="container-fluid mt-2 ">
                    <div class="row border-bottom border-danger mb-2">
                        <div class="col-lg-4 mb-2">
                            <video class="card-img-top" src="/storage/EaTube/{{$file->file}}" controls
                                   loop poster="{{ asset('images/videos.png') }}">{{$file->file}}</video>
                        </div>
                        <div class="col-lg-8 mb-2">
                            <div class="container-fluid">
                                <h5 class="border-bottom">{{$file->file}}</h5>
                                <p class="text-info"><small>{{$file->description}}</small></p>
                                @if($file->private)
                                    <p>Privacy <small class="text-info">Private</small> </p>
                                    @else
                                    <p>Privacy <small class="text-info">Public</small> </p>
                                @endif
                                <p>Uploaded on <small class="text-info">{{$file->created_at}}</small> </p>
                                <p>Last Update <small class="text-info">{{$file->updated_at}}</small> </p>
                            </div>
                            <div class="container-fluid">
                                <button class="pull-left btn btn-info" data-toggle="modal" data-target="#update{{$file->id}}">Update</button>
                                {!! Form::open(['action' => ['EaUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                <button type="submit" class="btn btn-danger">Delete<i class="fa fa-trash  text-white ml-1"></i></button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @include('EaTube.includes.update')
        @endforeach
        @include('EaTube.includes.upload')
        @else
        <div class="container-fluid mt-2">
            <h3 class="text-center text-info">You have not uploaded any files yet</h3>
            <div class="container mt-5">
                <p class="text-center text-success" style="font-size: 200px">
                    <a class="text-success" href="#" data-toggle="modal" data-target="#upload"><i class="fa fa-upload"></i></a>
                </p>
                <p class="text-center">
                    <a class="btn btn-info " href="{{url('/eatube')}}"><i class="fa fa-angle-left mr-1"></i> Back Home</a>
                </p>

            </div>
        </div>
     @include('EaTube.includes.upload')
    @endif

@endsection