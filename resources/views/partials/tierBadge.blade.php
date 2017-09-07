<h1>
    <button class="btn @if($tier == 'S')
            badge-success
@elseif($tier == 'A')
            badge-primary
@elseif($tier == 'B')
            badge-info
@elseif($tier == 'C')
            badge-secondary
@elseif($tier == 'D')
            badge-warning
@elseif($tier == 'E')
            badge-danger
@elseif($tier == 'F')
            badge-dark
@endif"><strong>{{ $tier }}</strong></button>
</h1>