
<nav class="navbar navbar-expand-lg sticky-top navbar-light  bg-info" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  " href="{{ url('/eatube') }}"><h4 >EaTube</h4></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <li class="nav-item ">
                <a class="nav-link  " href="{{ url('/trending') }}">Trending<i class="fa fa-rss ml-1"></i></a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{url('/EaUpload')}}">Upload<i class="fa fa-upload ml-1"></i> </a>
            </li>
            <!--Authentication-->
            @guest
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('login')}}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('register')}}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link  dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if ( Auth::user()->is_admin == true )
                            <a class="dropdown-item" href="/admin">Admin</a>
                        @else
                            <a class="dropdown-item" href="{{ url('/StudentsManagement') }}">Students Management</a>
                        @endif

                        <a class="dropdown-item" href="#"
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
