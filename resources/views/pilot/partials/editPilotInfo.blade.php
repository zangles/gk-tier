<div class="col-md-offset-4 col-md-4">
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