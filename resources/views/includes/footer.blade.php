
<footer class="container-fluid bg-grey py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="logo-part">
                            <img src="{{ asset('images/unii1.jpg') }}" class="w-50 logo-footer" alt="....">
                            <p class="para-links">Fulfilling the promise</p>
                            <p class="para-links">789936-894830 Mombasa, Kenya near Likoni Beach</p>
                        </div>
                    </div>
                    <div class="col-md-6 px-4">
                        <h6> About Bright University</h6>
                        <p class="para-links">We are always dedicated to give you quality education you deserve</p>
                        <a class="para-links btn-footer" href="#" > More Info </a><br>
                        <a class="para-links btn-footer" href="#" > Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 px-4">
                        <h6>Helpful links</h6>
                        <div class="row ">
                            <div class="col-md-6">
                                <ul>
                                    <li> <a class="para-links" href="{{url('/')}}"> Home</a> </li>
                                    <li> <a class="para-links" href="{{url('/about')}}"> About</a> </li>
                                    <li> <a class="para-links" href="{{url('/news')}}"> News</a> </li>
                                    <li> <a class="para-links" href="{{url('/students')}}"> Students</a> </li>
                                    <li> <a class="para-links" href="{{url('/courses')}}"> Programs</a> </li>
                                    <li> <a class="para-links" href="{{url('/projects')}}"> Projects</a> </li>
                                </ul>
                            </div>
                            <div class="col-md-6 px-4">
                                <ul>
                                    @if(!Auth::guest())
                                        @if(auth()->user()->is_student == true)
                                            <li> <a class="para-links " href="{{ url('/UnitsRegistration') }}">Examination</a></li>
                                        @endif
                                    @endif
                                    <li> <a class="para-links" href="{{url('/BrightDrive')}}"> BrightDrive</a> </li>
                                    <li> <a class="para-links" href="#"> Job vacancies</a> </li>
                                    <li> <a class="para-links" href="#"> Developers</a> </li>
                                    <li> <a class="para-links" href="#"> Timetable</a> </li>
                                    <li> <a class="para-links" href="#"> Assistance</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <h6> Subscribe</h6>
                        <div class="social">
                            <a class="para-links" href="#"><i class="btn fa fa-facebook bg-primary" aria-hidden="true"></i></a>
                            <a class="para-links" href="#"><i class="btn fa fa-twitter bg-info" aria-hidden="true"></i></a>
                            <a class="para-links" href="#"><i class="btn fa fa-instagram bg-danger" aria-hidden="true"></i></a>
                        </div>
                        <form class="form-footer my-3">
                            <input type="text"  placeholder="Email address" name="search">
                            <input type="button" value="Go" >
                        </form>
                        <p class="para-links">Thanks to Msembi Joseph<br><i class="fa fa-envelope mr-2" ></i>msembijoseph4@gmail.com</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>