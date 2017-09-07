<table class="table" data-filtering="true" data-sorting="true">
    <thead>
    <tr>
        <th data-sortable="false">Pilot</th>
        <th data-sortable="false">Type</th>
        @foreach($raids as $raid)
            <th class="td_tier td_{{ $raid->id }}" id="th_{{ $raid->name }} ">{{ $raid->name }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody style="overflow-y: auto">
    @foreach($pilots as $pilot)
        <tr class="tr_type tr_{{ $pilot->type }}">
            <td>
                <div style="height: 128px; width: 128px">
                    <img src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
                    <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
                </div>
                <p><strong>{{ $pilot->name }}</strong></p>
            </td>
            <td>
                {{ $pilot->type }}
            </td>
            @foreach($pilot->raid as $tier)
                <td class="td_tier td_{{ $tier->id }}">
                    @include('partials.tierBadge', ['tier' => $tier->pivot->tier ])
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

@section('scripts')
<script>
    jQuery(function($){
        $('.table').footable({
            @if(isset($raidId))
            "filtering": {
                "filters": [{
                    "name": "my-filter",
                    "query": "s",
                    "columns": [{{$raidId+1}}]
                }]
            }
            @endif
        });
    });
</script>
@endsection