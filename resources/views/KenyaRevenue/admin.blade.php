<div>
    <p class="card-link text-center"><a class="btn bg-info text-white" href="/KRA/create">ADD RECORD
            <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a> </p>
    @if (count($taxes)>0)
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>Gross Pay</th>
            <th>Net Pay</th>
        </tr>
        @foreach ($taxes as $tax)

            @foreach ($users as $user)
                @if ($tax->user_id == $user->id)
                    <tr >
                        <td><a href="#" data-toggle="modal" data-target="#tax{{$tax->id}}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>Ksh. {{ $tax->basic_pay + $tax->total_allowance }}</td>
                        <td>Ksh. {{ $tax->net_pay }}</td>
                    </tr>
                @endif
            @endforeach

        @endforeach

    </table>
        @else
        <h1>No record found</h1>
    @endif

    @if(count($taxes)>0)
        @foreach($taxes as $tax)
            <div class="modal fade" id="tax{{$tax->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            @foreach ($users as $user)
                                @if ($tax->user_id == $user->id)
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$user->name}}</h5>
                                @endif
                            @endforeach

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-5">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    @foreach ($users as $user)
                                        @if ($tax->user_id == $user->id)
                                            <h3>{{$user->name}}</h3>
                                            <h5 class="border-bottom border-info">Taxation Information as at
                                                <small class="text-info">{{ $tax->created_at }}</small></h5>
                                            <p>Basic pay: <small class="text-info">Ksh. {{ $tax->basic_pay }}</small></p>
                                            <p>Allowances: <small class="text-info">Ksh. {{ $tax->total_allowance }}</small></p>
                                            <p>Gross Income: <small class="text-info">Ksh. {{ $tax->basic_pay + $tax->total_allowance }}</small></p>
                                            <p>Deductions: <small class="text-info">Ksh. {{ $tax->total_deductions }}</small></p>
                                            <p>Taxable Income: <small class="text-info">Ksh. {{ $tax->taxable_income }}</small></p>
                                            <p>Personal Relief: <small class="text-info">Ksh. {{ $tax->personal_relief }}</small></p>
                                            <p>Tax Pay: <small class="text-info">Ksh. {{ $tax->tax_pay }}</small></p>
                                            <p>Pension percentage: <small class="text-info">{{ $tax->pension_percent }} % of basic pay</small></p>
                                            <p>Net Pay: <small class="text-info">Ksh. {{ $tax->net_pay }}</small></p>
                                        @endif
                                    @endforeach
                                    @if(!Auth::guest())

                                            <a href="/KRA/{{$tax->id}}/edit" class="btn btn-primary">Modify</a>

                                            {!! Form::open(['action' => ['TaxController@destroy', $tax->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}

                                    @endif
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

</div>
