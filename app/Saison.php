<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return Saison::firstOrCreate(['nom' => self::getNomActualSaison()]);
    }

    public static function getNomActualSaison()
    {
        $now = \Carbon\Carbon::now();
        if($now->month >= 9) {
            $saison = $now->year.'/'.($now->year)+1;
        } else {
            $saison = (($now->year)-1).'/'.$now->year;
        }
        return $saison;
    }




}
