<div class="row">
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda7.png') }}" alt="" class="pilotCell" data-position="7" id="cell_7" data-id="{{ old('pilot_7', $positions[7]->id ?? '') }}" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_7" name="pilot_7" value="{{ old('pilot_7', $positions[7]->id ?? '') }}">
    </div>
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda4.png') }}" alt="" class="pilotCell" data-position="4" id="cell_4" data-id="{{ old('pilot_4', $positions[4]->id ?? '') }}" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_4" name="pilot_4" value="{{ old('pilot_4', $positions[4]->id ?? '') }}">
    </div>
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda1.png') }}" alt="" class="pilotCell" data-position="1" id="cell_1" data-id="{{ old('pilot_1', $positions[1]->id ?? '') }}" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_1" name="pilot_1" value="{{ old('pilot_1', $positions[1]->id ?? '') }}">
    </div>
</div>
<div class="row" style="margin-top: 10px" >
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda8.png') }}" alt="" class="pilotCell" data-position="8" id="cell_8" data-id="{{ old('pilot_8', $positions[8]->id ?? '') }}" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_8" name="pilot_8" value="{{ old('pilot_8', $positions[8]->id ?? '') }}">
    </div>
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda5.png') }}" alt="" class="pilotCell" data-position="5" data-id="{{ old('pilot_5', $positions[5]->id ?? '') }}" id="cell_5" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_5" name="pilot_5" value="{{ old('pilot_5', $positions[5]->id ?? '') }}">
    </div>
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda2.png') }}" alt="" class="pilotCell" data-position="2" data-id="{{ old('pilot_2', $positions[2]->id ?? '') }}" id="cell_2" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_2" name="pilot_2" value="{{ old('pilot_2', $positions[2]->id ?? '') }}">
    </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda9.png') }}" alt="" class="pilotCell" data-position="9" data-id="{{ old('pilot_9', $positions[9]->id ?? '') }}" id="cell_9" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_9" name="pilot_9" value="{{ old('pilot_9', $positions[9]->id ?? '') }}">
    </div>
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda6.png') }}" alt="" class="pilotCell" data-position="6" data-id="{{ old('pilot_6', $positions[6]->id ?? '') }}" id="cell_6" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_6" name="pilot_6" value="{{ old('pilot_6', $positions[6]->id ?? '') }}">
    </div>
    <div class="col-xs-4" style="height: 128px">
        <img src="{{ asset('/img/celda3.png') }}" alt="" class="pilotCell" data-position="3" data-id="{{ old('pilot_3', $positions[3]->id ?? '') }}" id="cell_3" data-toggle="modal" data-target="#selectPilotModal">
        <input type="hidden" id="pilot_3" name="pilot_3" value="{{ old('pilot_3', $positions[3]->id ?? '') }}">
    </div>
</div>

<div class="modal fade" id="selectPilotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select a pilot for position </h4>
            </div>
            <div class="modal-body" style="height: 500px; overflow: auto">
                <div class="row removeDiv" style="display: none">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-danger removeBtn ">Remove</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Search</label>
                    <input type="text" class="form-control" id="search">
                </div>
                <table class="table">
                    @foreach($pilots as $pilot)
                        <tr class="pilotTr" id="trPilot_{{ $pilot->id }}">
                            <td width="130px">
                                <div style="height: 128px; left:-64px;">
                                    <img src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
                                    <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
                                </div>
                            </td>
                            <td>
                                {{ trans('gk.'.$pilot->name) }}
                                <p style="display: none" class="pilotName">{{ strtoupper(trans('gk.'.$pilot->name)) }}</p>
                            </td>
                            <td>
                                <button class="btn btn-primary addPilot" data-id="{{ $pilot->id }}">Add</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        var selectedPosition = 0;
        var cantSelected = {{ $cantSelected ?? 0 }};
        $(document).ready(function(){

            @if(($cantSelected ?? 0) > 0)
                @foreach($positions as $position=>$pilot)
                    @if($pilot != '')
                        addPilot( {{ $position }}, '{{ $pilot->id }}');
                    @endif
                @endforeach
            @endif

            $(".pilotCell").click(function(){
                selectedPosition = $(this).data('position');
                selectedPilot = $("#cell_"+selectedPosition).data('id');

                if (selectedPilot !== undefined || cantSelected < 5){
                    pilotCode = $(this).data('id');

                    if (selectedPilot !== undefined){
                        $(".removeDiv").show();
                    }

                    $("#myModalLabel").html('Select a pilot for position '+$(this).data('position'));
                } else {
                    alert('Only can select 5 pilots');
                    return false;
                }
            });

            $(".addPilot").click(function(){
                cantSelected++;
                pilotCode = $(this).data('id');

                previousPilot = $("#cell_"+selectedPosition).data('id');
                if (previousPilot !== undefined){
                    $("#trPilot_"+previousPilot).show();
                }


                addPilot(selectedPosition, pilotCode);

                $("#selectPilotModal").modal('hide');
            });

            $("#search").keyup(function(){
                searchPilot();
            });

            $(".removeBtn").click(function(){
                cantSelected--;
                pilotCode = $("#cell_"+selectedPosition).data('id');

                $("#trPilot_"+pilotCode).show();
                $("#cell_"+selectedPosition).attr('src', '{{ asset('/img/celda') }}'+selectedPosition+'.png');
                $("#cell_"+selectedPosition).removeData('id');
                $("#pilot_"+selectedPosition).val('');

                $("#selectPilotModal").modal('hide');

            });

            $('#selectPilotModal').on('hidden.bs.modal', function () {
                $(".removeDiv").hide();
            })

        });

        function addPilot(Position, pilotCode) {
            $("#trPilot_"+pilotCode).hide();
            $("#cell_"+Position).attr('src','http://gkgirls.info.gf/img/pilots/'+pilotCode+'.png');
            $("#cell_"+Position).data('id',pilotCode);

            $("#pilot_"+Position).val(pilotCode);
        }

        function searchPilot(){
            var search = $("#search").val().toUpperCase();
            if (search != '') {
                if (search.length >= 3){
                    $(".pilotTr").hide();
                    $(".pilotTr .pilotName:contains('"+search+"')").parents('.pilotTr').show();
                }
            } else {
                $(".pilotTr").show();
            }
        }
    </script>
@endsection