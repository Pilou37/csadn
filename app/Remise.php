<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remise extends Model
{
    public function mode()
    {
        return $this->BelongsTo('App\Mode');
    }

    public function reglements()
    {
        return $this->hasMany('App\Reglement');
    }
}
