@extends('inspinia.base')

@section('content')

    <div class="row">
        <div class="col-md-12 text-center">
            {{--<img class="img-responsive" src="{{ asset('/img/kraken.png') }}" alt="">--}}
        </div>
        <div class="col-md-10 col-md-offset-1">
            {{--<div class="ibox float-e-margins">--}}
                {{--<div class="ibox-title text-center">--}}
                    {{--<h1>New Pilot</h1>--}}
                {{--</div>--}}
                {{--<div class="ibox-content">--}}
                    {{--@include('partials.pilotTier', ['pilot' => \App\Pilot::find('c_067')])--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pilot list</h5>
                </div>
                <div class="ibox-content pilotList">
                    @include('partials.tierTable')
                </div>
            </div>
        </div>
    </div>
@endsection