@extends('inspinia.base')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Pilot info</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">

                        @include('partials.pilotTier')
                    </div>
                    <div class="col-md-12 text-center">
                        <a href="http://gkgirls.info.gf/pilots/{{$pilot->id}}.html" target="_blank" class="btn btn-info">Extended Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection