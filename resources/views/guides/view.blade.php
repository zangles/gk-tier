@extends('inspinia.base')

@section('content')
    <div class="row">
        @if ($guide->user_id == Auth::user()->id)
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content text-center">
                        <a href="{{ route('guides.edit',$guide) }}" class="btn btn-success">Edit guide</a>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            @include('guides.partials.guidePosition')
                        </div>
                        <div class="col-md-8 col-xs-12">
                            {{--<div class="ibox float-e-margins">--}}
                                {{--<div class="ibox-content">--}}
                                    {{--votos y extras--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Description</h5>
                                </div>
                                <div class="ibox-content">
                                    {!! $guide->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection