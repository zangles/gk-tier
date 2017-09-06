<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    public function raid()
    {
        return $this->belongsToMany('App\Raid')->withPivot('tier');
    }

    public function formatedId()
    {
        $id = $this->id;
        $rtrn = '';
        for ($i=count((string)$id); $i<3; $i++ ) {
            $rtrn .= '0';
        }

        return $rtrn.$id;

    }
}
