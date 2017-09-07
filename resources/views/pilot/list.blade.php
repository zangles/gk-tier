@extends('inspinia.base')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pilot list</h5>
                </div>
                <div class="ibox-content">
                    @include('partials.tierTable')
                </div>
            </div>
        </div>
    </div>
@endsection