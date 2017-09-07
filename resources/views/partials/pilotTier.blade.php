<table class="table">
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
        <tr class="tr_type tr_{{ $pilot->type }}">
            <td>
                <a href="{{ route('pilot', $pilot) }}">
                    <div style="height: 128px; width: 128px">
                        <img src="http://gkgirls.info.gf/img/pilots/{{ $pilot->id }}.png" alt="" style="position: absolute">
                        <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
                    </div>
                    <p><strong>{{ $pilot->name }}</strong></p>
                </a>
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
    </tbody>
</table>