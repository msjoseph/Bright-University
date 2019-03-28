 <!-- Units Basket Modal -->
 <div class="modal fade" id="unitsBasketModal" tabindex="-1" role="dialog" aria-labelledby="unitsBasketModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">
                  <small class="text-info">{{ $student->first_name }} {{ $student->last_name }} , {{$student->adm_num}}
                      - Year {{$student->year}} Sem {{$student->semester}}</small>
                  @foreach($year as $yr)
                      <small class="text-danger">{{ $yr->academic_year }}</small>
                  @endforeach

              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h6 class="text-danger text-center"><small>Please note that you cannot de-register units after submitting</small></h6>
                @if (count($registeredUnits)>0)

                <table class="table table-striped">
                    @foreach ($registeredUnits as $registeredUnit)
                        @foreach ($units as $unit)
                            @if ($registeredUnit->unit_id == $unit->id)
                                @if($registeredUnit->is_submitted != true)
                                <tr>
                                    <td>{{ $unit->code }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>
                                        {!! Form::open(['action' => ['UnitsRegistrationController@destroy', $unit->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                    @else
                                    <tr>
                                        <td>{{ $unit->code }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td><small class="text-info">Submitted</small></td>
                                    </tr>
                                @endif
                            @endif

                        @endforeach

                    @endforeach
                </table>
                    @else
                    <p class="text-center">You have not registered any units</p>
                @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
