<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PilotsOopartsGuide extends Model
{
    public function oopart()
    {
        return $this->belongsTo('App\Oopart');
    }
}
