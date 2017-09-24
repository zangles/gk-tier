<div class="row pilotDiv " style="border-bottom: 1px solid #E7EAEC; margin-bottom: 15px;padding-bottom: 15px">
    <div class="col-md-12">
        <p style="display: none" class="pilotName">{{ strtoupper(trans('gk.'.$pilot->name)) }}</p>
        <p><strong>{{ trans('gk.'.$pilot->name) }}</strong></p>
    </div>
    <div class="col-md-3 col-sd-12 text-center">
        <a href="{{ route('pilot', $pilot) }}">

            <div style="height: 128px; left:-64px; position: relative;">
                <img src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
                <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
            </div>
        </a>
        <img style="position: relative; margin-top: 10px" src="{{ asset('img/'.$pilot->type.'.png') }}" alt="">
    </div>
    <div class="col-md-9 col-sd-12">
        <div class="row">
            <div class="col-md-6 col-sd-12">
                @if (count($pilot->raid) == 0)
                        <br><br><h1>No info yet</h1>
                @else
                    @foreach($raids as $raid)
                        @if($loop->index == 3)
                            </div>
                            <div class="col-md-6 col-sd-12">
                        @endif
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-xs-6">
                                    <strong>{{ trans('gk.'.$raid->name) }}</strong>
                                </div>
                                <div class="col-xs-6 text-left">
                                    <img style="max-height: 40px" src="{{ asset('/img/'.$pilot->raid()->find($raid->id)->pivot->tier.'.png') }}" alt="">
                                </div>
                            </div>
                    @endforeach
                @endif
            </div>
            <br>
        </div>
    </div>
</div>

