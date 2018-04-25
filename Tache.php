<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
	protected $guarded = [];
    function equipe () {
        return $this->belongsTo(equipe::class);
    }
}
