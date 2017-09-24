<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PilotsGuide extends Model
{
    public function guide()
    {
        return $this->hasOne('App\Guide');
    }

    public function dress()
    {
        return $this->belongsTo('App\pilotsDress')->get()->first();
    }

    public function pilot()
    {
        return $this->belongsTo('App\Pilot')->get()->first();
    }

    public function ooparts()
    {
        return $this->hasMany('App\PilotsOopartsGuide')->get();
    }
}
