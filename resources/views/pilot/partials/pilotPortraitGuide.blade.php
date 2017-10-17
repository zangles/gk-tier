@if(!empty($pilot))
    <div style="height: 128px; left:-64px;" data-toggle="modal" data-target="#modal_{{$pilot->id}}">
        <img class="img-responsive" src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
        <img class="img-responsive" src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
    </div>

    <div class="modal fade" id="modal_{{$pilot->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @include('partials.pilotTier')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif