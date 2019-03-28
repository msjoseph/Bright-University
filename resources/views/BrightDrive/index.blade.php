@extends('base')
@section('title')
    BrightDrive
@endsection

@section('content')
    <style type="text/css">
        img{
            max-width: 100%;
            height: auto;
        }
        video{
            max-width: 100%;
            height: auto;
        }
        audio{
            max-width: 100%;
        }
    </style>
    <div class="container-fluid mt-2 sticky-top">
        @include('includes.drivenav')
    </div>
    <div class="container-fluid mt-4 border-bottom row">
        <div class="col-lg-6">
            <h3 class="text-center text-info">Welcome to BrightDrive</h3>
        </div>
        <div class="col-lg-6">
            @if(!Auth::guest())
                @if(count($accounts)>0)
                    @foreach($accounts as $account)
                        @if($account->user_id == auth()->user()->id)
                            @if($account->plan == 'free5')
                                <p><a class="btn btn-success pull-right">Ultimate <i class="ml-1 fa fa-arrow-up text-white"></i> </a></p>
                            @endif

                        @endif
                    @endforeach
                @endif
            @endif
        </div>


    </div>
    @if(!Auth::guest())
        @if(count($accounts)>0)
            @foreach($accounts as $account)
                @if($account->user_id == auth()->user()->id)
                    @include('BrightDrive.DriveUser')
                    @else
                    @include('BrightDrive.guest')
                @endif
            @endforeach
        @endif
        @else
        @include('BrightDrive.guest')
    @endif
    <div class="container-fluid mt-2 mb-1">
        @include('includes.footer')
    </div>

@endsection