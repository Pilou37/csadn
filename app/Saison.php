<?php

namespace App;

use Carbon\Carbon;
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

    public static function isInActualSaison($date)
    {
        if($date) {
            $date = new Carbon($date);
            $now = \Carbon\Carbon::now();
            if($now->month >= 9) {
                $start = Carbon::createFromDate($now->year, 9, 1, 'Europe/Paris');
                $end = Carbon::createFromDate(($now->year)+1, 8, 31, 'Europe/Paris');
                return $date->isBetween($start, $end);
            } else {
                $start = Carbon::createFromDate(($now->year)-1, 9, 1, 'Europe/Paris');
                $end = Carbon::createFromDate($now->year, 8, 31, 'Europe/Paris');
                return $date->isBetween($start, $end);
            }
        } else {
            return false;
        }
    }


    public function scopeNbAdherents($query)
    {
        $saison = self::getActualSaison();

        return $query->select('activites.*', DB::raw('COUNT(users.id) as nb_adherents'))
        ->leftJoin('saison_user', 'saisons.id', '=', 'saison_user.saison_id')
        ->leftJoin('users', 'users.id', '=', 'saison_user.user_id')
        ->leftJoin('activites', 'activites.id', '=', 'users.activite_id')
        ->where('saisons.nom', $saison->nom)
        ->groupBy('users.activite_id');
    }



}
