<div class="col-md-7">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>{{ trans('gk.'.$guidePilot->pilot()->name) }}</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 128px; width: 128px; display: inline-block;">
                                <img src="http://gkgirls.info.gf/img/pilots/{{ $guidePilot->pilot()->id }}.png" alt="" style="position: absolute">
                                <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot" style="position: absolute">
                                <img src="{{ asset('/img/'.$guidePilot->pilot_stars.'.png') }}" alt="" style="display: inline-block;max-height: 128px; padding-left: 145px">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="" style="margin-top:10px;width:292px; height:230px; background-image: url('{{ asset('/img/oopartsBg.jpg') }}'); background-size: 100% 100% ">
                                <div class="" style="height: 115px; width:49%; display: inline-block">1</div>
                                <div class="" style="height: 115px; width:49%; display: inline-block">2</div>
                                <div class="" style="height: 115px; width:49%; display: inline-block">3</div>
                                <div class="" style="height: 115px; width:49%; display: inline-block">4</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" style="">
                    <div style="margin-left: 15px;height: 368px; width: 293px; background-image: url('{{ asset('/img/infoBG.jpg') }}'); background-size: 100% 100%">

                        <ul>
                            <li>Position: {{ $guidePilot->position }}</li>
                            <li>Level: {{ $guidePilot->pilot_level }}</li>
                            <li>Stars: {{ $guidePilot->pilot_stars }}</li>
                            <li>Affection level: {{ $guidePilot->affection_level }}</li>
                            <li>Dress: {{ trans('gk.'.$guidePilot->dress()->name) }}</li>
                            <li>wave: {{ $guidePilot->wave }}</li>
                        </ul>
                        Opparts
                        <ul>
                            @foreach($guidePilot->ooparts() as $oopart)
                                <li>{{ $oopart->id }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            

        </div>
    </div>
</div>