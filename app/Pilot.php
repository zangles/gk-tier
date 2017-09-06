<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    protected $casts = ['id' => 'string'];

    public function raid()
    {
        return $this->belongsToMany('App\Raid')->withPivot('tier');
    }

    public function formatedId()
    {
        $id = $this->id;
        $rtrn = '';
        for ($i=strlen((string)$id); $i<3; $i++ ) {
            $rtrn .= '0';
        }

        return $rtrn.$id;
    }

    public function findRaidTierByRaidId($raidId)
    {
        return $this->raid()->where('raids.id', $raidId)->get()->first()->pivot->tier;
    }
}
