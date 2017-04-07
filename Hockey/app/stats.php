<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stats extends Model
{
    //

    public function partie(){
    	return $this->belongsToMany(Partie::class);
    }
}
