<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activite extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNbAdherents($query)
    {
        $saison = Saison::getActualSaison();

        return $query->select('activites.*', DB::raw('COUNT(users.id) as nb_adherents'))
        ->leftJoin('saison_user', 'saisons.id', '=', 'saison_user.saison_id')
        ->leftJoin('users', 'users.id', '=', 'saison_user.user_id')
        ->leftJoin('activites', 'activites.id', '=', 'users.activite_id')
        ->where('saisons.nom', $saison->nom)
        ->groupBy('users.activite_id');
    }
}
