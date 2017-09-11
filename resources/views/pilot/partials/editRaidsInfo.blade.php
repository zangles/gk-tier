<div class="col-md-offset-2 col-md-8">
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