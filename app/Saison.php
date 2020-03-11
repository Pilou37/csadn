<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public static function getActualSaison()
    {
        $now = \Carbon\Carbon::now();
        if($now->month >= 9) {
            $saison = $now->year.'/'.($now->year)+1;
        } else {
            $saison = (($now->year)-1).'/'.$now->year;
        }
        return Saison::firstOrCreate(['nom' => $saison]);
    }
}
