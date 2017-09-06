@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Edit Pilots</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('pilot.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('pilot.update', $pilot) }}" method="post">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id">ID:</label>
                                        <input type="text" class="form-control" id="id" name="id" value="{{ $pilot->id }}">
                                        <input type="hidden" class="form-control" id="old_id" name="old_id" value="{{ $pilot->id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nombre:</label>
                                        <input type="text" class="form-control" id="name" name="name"  value="{{ $pilot->name }}">
                                    </div>
                                    <label for="name">Type:</label>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default pilot-type">Attack</button>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default pilot-type">Defense</button>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default pilot-type">Support</button>
                                        </div>

                                    </div>
                                    <button class="btn btnType">{{ $pilot->type }}</button>
                                    <input type="hidden" id="pilotType" name="pilotType"  value="{{ $pilot->type }}">
                                </div>
                                <div class="col-md-8">
                                    @foreach($raids as $raid)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                {{ $raid->name }}
                                            </div>
                                            <div class="panel-body text-center">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="raid_{{ $raid->id }}" id="raid_tier_{{ $raid->id }}" value="{{ $pilot->findRaidTierByRaidId($raid
                                                        ->id) }}">
                                                        <button class="btn" id="raid_tier_btn_{{ $raid->id }}">{{ $pilot->findRaidTierByRaidId($raid
                                                        ->id) }}</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="btn-group" role="group" aria-label="...">
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">S</button>
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">A</button>
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">B</button>
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">C</button>
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">D</button>
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">E</button>
                                                            <button type="button" class="btn btn-default btn-tier" data-raid="{{ $raid->id }}">F</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
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

