<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guides extends Model
{
    public function pilots()
    {
        return $this->hasMany('App\PilotsGuide');
    }

    public function user()
    {
        return $this->belongsTo('App\User')->get()->first();
    }
}
