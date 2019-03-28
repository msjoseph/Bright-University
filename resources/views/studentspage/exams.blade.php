<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div  >
            <div >
                <img class="card-img-top" src="{{ asset('images/adults-business-computer-1181371.jpg') }}" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">Units Registration</h5>
                <p class="card-text"><small>Register your course units before sitting for exams</small></p>
                <h6 class="card-link"><a href="{{url('/UnitsRegistration')}}">REGISTER NOW<i class="fa fa-angle-right ml-3 mr-2"
                      style="font-size:20px;"></i> </a>
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div  >
            <div >
                <img class="card-img-top" src="{{ asset('images/gettyimages-469329288-1024x1024.jpg') }}" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">Examination Code</h5>
                <p class="card-text"><small>Exam code is a secret key for you to sit for any exam.</small></p>
                <h6 class="card-link"><a href="/examcode" data-toggle="modal" data-target="#examcode">
                        GET YOUR CODE<i class="fa fa-angle-right ml-3 mr-2" style="font-size:20px;"></i> </a>
                </h6>
                @if(!Auth::guest())
                    @if(auth()->user()->is_student == true)
                        @foreach($students as $student)
                            @if($student->user_key == auth()->user()->student_key)
                                @if($student->debit >= $student->credit)
                                    @foreach($examCodes as $examCode)
                                        @if($examCode->student_id == $student->id)
                                            <div class="modal fade" id="examcode" tabindex="-1" role="dialog" aria-labelledby="examcodeTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="examcodeTitle"><small class="text-info">{{$student->adm_num}}</small></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <p class="text-center text-danger"><small>Keep this code a secret</small></p>
                                                                <p class="text-center text-info"><small>{{$examCode->code}}</small></p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div  >
            <div >
                <img class="card-img-top" src="{{ asset('images/adolescent-business-computer-1595391.jpg') }}" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">Exam Revision</h5>
                <p class="card-text"><small>Please students revise for this semester exam to score high.</small></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div  >
            <div >
                <img class="card-img-top" src="{{ asset('images/image2.jpg') }}" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">Exam Results</h5>
                <p class="card-text"><small>The 2018/2019 exam results are out. Confirm your marks.</small></p>

                        @if(!Auth::guest())
                            @if(auth()->user()->is_student)
                                <h6 class="card-link"><a href="#" data-toggle="modal" data-target="#marks">VIEW NOW
                                        <i class="fa fa-angle-right ml-3 mr-2" style="font-size:20px;"></i> </a></h6>
                                    @else
                                        <h6 class="card-link"><a href="#">LOGIN AS STUDENT</a></h6>
                            @endif
                                    @else
                                        <h6 class="card-link"><a href="{{route('login')}}">LOGIN FIRST
                                                <i class="fa fa-angle-right ml-3 mr-2" style="font-size:20px;"></i> </a>
                        @endif


                </h6>
            </div>
        </div>
    </div>
    @if(!Auth::guest())
        @if(auth()->user()->is_student)
            <div class="modal fade" id="marks" tabindex="-1" role="dialog" aria-labelledby="marksTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="marksLongTitle"><small class="text-info">
                                    @foreach($students as $student)
                                        @if($student->user_key == auth()->user()->student_key)
                                            {{$student->adm_num}}
                                        @endif
                                    @endforeach
                                </small></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-success"><small>Null means the particular marks are not yet uploaded</small></p>
                            <div class="container-fluid">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <th>Unit Code</th>
                                        <th>Cat Mark</th>
                                        <th>Exam Mark</th>
                                    </tr>
                                    @if(count($marks)>0)
                                        @foreach($marks as $mark)
                                            <tr>
                                                @foreach($units as $unit)
                                                    @if($unit->id == $mark->unit_id)
                                                        <td>{{$unit->code}}</td>
                                                    @endif
                                                @endforeach
                                                @if($mark->cat == null)
                                                        <td><small class="text-info">Null</small></td>
                                                    @else
                                                        <td><small class="text-info">{{$mark->cat}}</small> </td>
                                                @endif
                                                @if($mark->exam == null)
                                                         <td><small class="text-info">Null</small></td>
                                                    @else
                                                        <td><small class="text-info">{{$mark->exam}}</small> </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                    @endif

                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

</div>