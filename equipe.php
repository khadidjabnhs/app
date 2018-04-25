<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipe extends Model
{
        
    
    function taches () {
        return $this->hasMany(tache::class);
    }
}