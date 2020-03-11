<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
