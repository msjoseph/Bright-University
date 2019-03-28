<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-dark container-fluid" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  text-white " href="{{ url('/') }}"><h4 >Bright University</h4></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            @if(!Auth::guest())
                @if(auth()->user()->drive_user)
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{url('/BrightDriveUpload')}}">Upload<i class="fa fa-upload ml-1"></i> </a>
                    </li>
                    @if($plan == 'free5')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Ultimate<i class="fa fa-arrow-up ml-1"></i> </a>
                        </li>
                    @endif
                @endif
            @endif

            <!--Authentication-->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif

            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link  dropdown-toggle text-white" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">



                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

        </ul>

    </div>
</nav>
