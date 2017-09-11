@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">New Pilots</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('pilot.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('pilot.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Pilot Info</a></li>
                                        <li role="presentation"><a href="#dresses" aria-controls="dresses" role="tab" data-toggle="tab">Dresses</a></li>
                                        <li role="presentation"><a href="#raids" aria-controls="raids" role="tab" data-toggle="tab">Raid Info</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="info">
                                            <br>
                                            @include('pilot.partials.createPilotInfo')
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="dresses">
                                            <br>
                                            @include('pilot.partials.createPilotDresses')
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="raids">
                                            <br>
                                            @include('pilot.partials.createRaidsInfo')
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <hr>
                                        <button class="btn btn-success" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.pilot-type').click(function(){
                type = $(this).html();
                $("#pilotType").val(type);
                $(".btnType").html(type);
            });
            $('.btn-tier').click(function(){
                raid = $(this).data('raid');
                tier = $(this).html();
                $("#raid_tier_"+raid).val(tier);
                $("#raid_tier_btn_"+raid).html(tier);
            });
        });
    </script>
@endsection

