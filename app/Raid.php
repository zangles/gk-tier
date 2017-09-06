<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raid extends Model
{
    public function Pilot()
    {
        return $this->belongsToMany('App\Pilot')->withPivot('tier');
    }
}
