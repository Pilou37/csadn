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

        return $query->select('activites.*', DB::raw('ANY_VALUE(saisons.nom) as saison') , DB::raw('COUNT(users.id) as nb_adherents'))
        ->rightJoin('users', 'activites.id', '=', 'users.activite_id')
        ->rightJoin('saison_user', 'users.id', '=', 'saison_user.user_id')
        ->rightJoin('saisons', 'saison_user.saison_id', '=', 'saisons.id')
        ->groupBy('users.activite_id')
        ->having('saison', $saison->nom);
    }
}
