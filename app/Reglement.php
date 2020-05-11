<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function remise()
    {
        return $this->BelongsTo('App\Remise');
    }

    public function mode()
    {
        return $this->BelongsTo('App\Mode');
    }
}
