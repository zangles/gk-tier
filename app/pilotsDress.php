<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pilotsDress extends Model
{
    public function Pilot()
    {
        return $this->belongsTo('App\Pilot');
    }
}
