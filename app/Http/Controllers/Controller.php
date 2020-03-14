<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Renvoi à la page d'accueil et affiche une erreur.
     *
     * @return \Illuminate\Http\Response
     */

    protected function unauthorized()
    {
        return redirect()->route('index')->with('error', 'Vous n\'avez pas l\'autorisation d\'acceder à cette ressource.');
    }
}
