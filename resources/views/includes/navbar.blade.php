<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-dark" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  text-white" href="{{ url('/') }}"><h4 >Bright University</h4></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <li class="nav-item ">
                <a class="nav-link  text-white" href="{{url('/BrightDrive')}}">BrightDrive</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white " href="{{ url('/news') }}">News</a>
            </li>

            <li class="nav-item">
                @if(!Auth::guest())
                    @if(auth()->user()->is_admin)
                        <a class="nav-link text-white " href="{{ url('/StudentsManagement') }}">Students</a>
                        @else
                        <a class="nav-link text-white " href="{{ url('/students') }}">Students</a>
                    @endif
                @else
                    <a class="nav-link text-white " href="{{ url('/students') }}">Students</a>
                @endif
            </li>

            @if(!Auth::guest())
                @if(auth()->user()->is_admin == true && auth()->user()->fee_admin == true)
                    <a class="nav-link text-white " href="{{ url('/finance') }}">Finance</a>
                @endif
            @endif
            @if(!Auth::guest())
                @if(auth()->user()->is_admin == true )
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{url('/lecturers')}}">Lecturers</a>
                    </li>
                @endif

            @endif


            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Extra</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item " href="{{ url('/projects') }}">Projects</a>
                    <a class="dropdown-item " href="{{ url('/schools') }}">Schools</a>
                    <a class="dropdown-item " href="{{ url('/courses') }}">Degree Programs</a>
                    <a class="dropdown-item " href="{{ url('/units') }}">Course Units</a>
                    @if(!Auth::guest())
                        @if(auth()->user()->is_student == true)
                            <a class="dropdown-item " href="{{ url('/UnitsRegistration') }}">Units Registration</a>
                        @endif
                    @endif

                    @if(!Auth::guest())
                        @if(auth()->user()->is_lecturer == true)
                            <a class="dropdown-item " href="{{ url('/SubmitMarks') }}">Submit Marks</a>
                        @endif
                    @endif





                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/hostels') }}">Hostels</a>
            </li>

            <!--Authentication-->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            <!--
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                -->
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
