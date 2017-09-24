@extends('inspinia.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>fdsf</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        @foreach($guide->pilots()->get() as $guidePilot)
                            @include('guides.partials.guidePilotInfo')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection