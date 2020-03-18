<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*
    protected $fillable = [
        'name', 'email', 'password',
    ];*/

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ---------------------- MUTATEURS
     */

    /**
     * Mutateur date de naissance.
    public function getNaissanceAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
    */

    public function getNaissanceAtShowAttribute()
    {
        return \Carbon\Carbon::parse($this->naissance_at)->format('d/m/Y');
    }

    public function getSouscribeStatus() {

        if($this->validation_at) {
            $actualSaison = Saison::getNomActualSaison();
            if($this->saisons()->where('saisons.nom', $actualSaison)->first()) {
                    return ['class' => 'success',
                            'mess' => 'OK',
                            'pourcent' => 100];
            } else {
                return ['class' => 'warning',
                        'mess' => 'Attente sygelic',
                        'pourcent' => 75];
            }
        } else {
            return ['class' => 'danger',
                    'mess' => 'Attente validation',
                    'pourcent' => 50];
        }
    }

    public function addRole($nomRole)
    {
        $role = Role::where('nom', $nomRole)->first();

        if($role) {
            $this->roles()->attach($role);
        }
    }

    public function remRole($nomRole)
    {
        $role = Role::where('nom', $nomRole)->first();

        if($role) {
            $this->roles()->detach($role);
        }
    }

    public function isOwner($owner)
    {
        return $this->id == $owner->id;
    }

    public function isSupervisor($owner)
    {
        if($this->roles()->where('nom', 'responsable')->first()) {
            return $this->activite_id == $owner->activite_id;
        }
        return false;
    }

    public function isAdmin()
    {
        return $this->roles()->where('nom', 'admin')->first();
    }

    public function hasAnyRole(array $roles)
    {
        return $this->roles()->whereIn('nom', $roles)->first();
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdherentsParSaison($query, $saisonId)
    {
        /*
        $saison = Saison::getActualSaison();

        return $query->select('activites.*', DB::raw('ANY_VALUE(saisons.nom) as saison') , DB::raw('COUNT(users.id) as nb_adherents'))
        ->rightJoin('users', 'activites.id', '=', 'users.activite_id')
        ->rightJoin('saison_user', 'users.id', '=', 'saison_user.user_id')
        ->rightJoin('saisons', 'saison_user.saison_id', '=', 'saisons.id')
        ->groupBy('users.activite_id')
        ->having('saison', $saison->nom);
        */

        return $query->select('users.*', DB::raw('saisons.id as saison'))
        ->rightJoin('saison_user', 'users.id', '=', 'saison_user.user_id')
        ->rightJoin('saisons', 'saison_user.saison_id', '=', 'saisons.id')
        ->having('saison', $saisonId);
    }

    /**
     * ----------------------- RELATIONS
     */

    public function activite()
    {
        return $this->BelongsTo('App\Activite');
    }

    public function reglements()
    {
        return $this->hasMany('App\Reglement');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    public function saisons() {
        return $this->belongsToMany('App\Saison');
    }
}
