@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">Pilots</div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('pilot.create') }}" class="btn btn-success">New Pilot</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-center">
                                Pilot
                            </th>
                            <th colspan="6" class="text-center">
                                Battles
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <th width="130px">Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            @foreach($raids as $raid)
                                <th class="td_tier td_{{ $raid->id }} text-center" id="th_{{ $raid->name }} ">{{ $raid->name }}</th>
                            @endforeach
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pilots as $pilot)
                            <tr class="tr_type tr_{{ $pilot->type }}">
                                <td>
                                    <div style="height: 128px; width: 128px">
                                        <img src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
                                        <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
                                    </div>
                                </td>
                                <td>
                                    <p><strong>{{ $pilot->name }}</strong></p>
                                </td>
                                <td>
                                    <p><strong>{{ $pilot->type }}</strong></p>
                                </td>
                                @foreach($pilot->raid as $tier)
                                    <td class="td_tier td_{{ $tier->id }} text-center">
                                        <button class="btn">{{$tier->pivot->tier}}</button>
                                    </td>
                                @endforeach
                                <td>
                                    <a href="{{ route('pilot.edit',$pilot) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route('pilot.destroy', $pilot) }}" method="post" id="formDeletePilot_{{ $pilot->id }}" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger deletePilot" data-id="{{ $pilot->id }}" type="button">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <a href="http://gkgirls.info.gf/pilots/{{ $pilot->id }}.html" target="_blank" class="btn btn-primary">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(".deletePilot").click(function(){
                id = $(this).data('id');
                if(confirm('Esta seguro quiere eliminar a esta piloto?')) {
                    $('#formDeletePilot_'+id).submit();
                }
            });
        });
    </script>
@endsection

