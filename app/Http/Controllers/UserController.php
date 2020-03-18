<?php

namespace App\Http\Controllers;

use App\Activite;
use App\Http\Controllers\Auth\LoginController;
use App\Mail\PasswordMail;
use App\Mail\SuscribeMail;
use App\Role;
use App\Rules\Telephone;
use App\Saison;
use App\User;
//use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\UploadedFile as File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

// ----------------------------- CRUD -------------------------------------

    /**
     * Affiche la liste des adhérents en fonction des droits
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $saison = DB::table('saisons')
                    ->select('users.activite_id as activite','saisons.nom as saison', DB::raw('COUNT(users.id) as user'))
                    ->leftJoin('saison_user', 'saisons.id', '=', 'saison_user.saison_id')
                    ->leftJoin('users', 'saison_user.user_id', '=', 'users.id')
                    ->groupBy('users.activite_id')
                    ->having('saisons.nom', '2019/2020')
                    ->get();
        */


        if(Gate::allows('secretariat'))
        {
            $users = User::whereHas('saisons', function ($query) {
                            $query->where('nom', '2019/2020');  })
                            ->with(['activite','roles','saisons'])
                            ->get();
        }
        elseif (Gate::allows('responsable-section'))
        {
            $users = User::whereHas('saisons', function ($query) {
                            $query->where('nom', '2019/2020');  })
                            ->with(['activite','roles','saisons'])
                            ->where('activite_id', auth()->user()->activite_id)
                            ->get();
        }
        else
        {
            return $this->unauthorized();
        }

        return view('user.liste')->with('users', $users);
    }

    /**
     * Affichage du formulaire de pré-inscription
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Enregistrement de l'adhérent
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator();

        $user = User::firstOrNew(
            ['nom' => $data['nom']],
            ['prenom' => $data['prenom']],
            ['naissance_at' => $data['naissance_at']]
        );

        $user->fill($data);
        $user->save();

        if(isset($data['photo'])) { $this->storePhoto($user, $data['photo']); } //Stockage photo
        if(isset($data['certif'])) { $this->storeCertif($user, $data['certif']); } //Stockage certificat
        $password = $this->initPassword();
        if(isset( $password)) { $this->storePassword($user,  $password); } //Stockage mot de passe

        Mail::to($user->email)->send(new SuscribeMail($user));

        //$request->session()->flash('success', 'C\'est un succès');
        //dd($user);

        $request->merge(['password' => $password]);

        $loginControl = new LoginController();
        $loginControl->login($request);

        return redirect()->route('user.show', $user)->with('success', 'Adhérent créé');
    }

    /**
     * Visualisation des informations d'un adhérent
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Gate::allows('proprietaire', $user))
        {
            return view('user.show')->with('user', $user);
        }
        else
        {
            return $this->unauthorized();
        }
    }

    /**
     * Formulaire pour l'édition des informations d'un adhérent
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::allows('edit-user', $user))
        {
            return view('user.form')->with('user', $user);
        }
        else
        {
            return $this->unauthorized();
        }


    }

    /**
     * Mise à jour du profil de l'adhérent
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validator();

        $user->fill($data);
        if(isset($data['photo'])) { $this->storePhoto($user, $data['photo']); } //Stockage photo
        if(isset($data['certif'])) { $this->storeCertif($user, $data['certif']); }//Stockage certificat

        $user->save();

        //$request->session()->flash('success', 'C\'est un succès');

        return redirect()->route('user.show', $user)->with('success', 'Informations modifiées');
    }

    /**
     * Suppression de l'adhérent
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::allows('administrateur')) {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Adhérent supprimé');
        }
        else
        {
            return $this->unauthorized();
        }
    }

        /**
     * Affiche la liste des adhérents en fonction des droits
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserSaison($saisonId)
    {

        if(Gate::allows('secretariat'))
        {
            //dd($saisonId);
            $users = User::AdherentsParSaison($saisonId)
                            ->with(['activite','roles'])
                            ->get();
                            //dd($users);
        }
        elseif (Gate::allows('responsable-section'))
        {
            $users = User::whereHas('saisons', function ($query) {
                            $query->where('id', $saisonId);  })
                            ->with(['activite','roles','saisons'])
                            ->where('activite_id', auth()->user()->activite_id)
                            ->get();
        }
        else
        {
            return $this->unauthorized();
        }

        return view('user.liste')->with('users', $users);
    }

    /**
     * Mise a jour des status des adhérents
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function majStatus(User $user)
    {
        if(Gate::denies('administrateur')) { return $this->unauthorized(); }

        $data = request()->validate([
            'doc_check'     => 'sometimes|digits:1',
            'licence_check' => 'sometimes|digits:1',
            'licence'       => 'sometimes',
            'roles.*'       => 'sometimes|digits:1']);

        // Boutton "Dossier complet"
        $user->validation_at = null;

        if(isset($data['doc_check'])) {
            if($data['doc_check'] == 1) {
                $user->validation_at = now();
            }
        }

        // Boutton "Licence saisie"
        $saison = Saison::getActualSaison();

        if(isset($data['licence_check'])) {
            $user->saisons()->syncWithoutDetaching($saison);
        } else {
            $user->saisons()->detach($saison);
        }

        // Champ "Numéro de licence"
        $user->licence = null;

        if(isset($data['licence'])) {
            $user->licence = $data['licence'];
        }

        // Boutton "Fonctions"
        $userRoles = array();

        if(isset($data['roles'])) {
            if(is_array($data['roles'])) {
                $userRoles = $data['roles'];
            }
        }

        $user->save();
        $user->roles()->sync($userRoles);

        return redirect()->route('user.show', $user)->with('success', 'Informations modifiées');
    }

    /**
     * Filtres pour validation inscription et mise à jour
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function validator() {
        return request()->validate([
            'genre'         => 'required|digits_between:1,2',
            'nom'           => 'required|string',
            'prenom'        => 'required|string',
            'naissance_at'  => 'required|date',
            'naissance_lieu'=> 'required|string',
            'adresse'       => 'required|string',
            'cp'            => 'required|string',
            'ville'         => 'required|string',
            'tel'           => ['required', new Telephone],
            'email'         => 'required|email',
            'photo'         => 'sometimes|image|mimes:jpeg,jpg,png,jpg,gif,svg|max:5000',
            'certif'        => 'sometimes|file',
            'certif_at'     => 'required|date',
            'activite_id'   => 'required|digits_between:1,20',
            'origine'       => 'required|digits_between:1,4'
        ]);
    }

    /**
     * Sauvegarde photo adhérent
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return \Illuminate\Http\Response
     */
    private function storePhoto(User $user, File $photo)
    {
        if($photo) {
            $filename = 'ident_'.$user->id.'.'.$photo->clientExtension();
            $user->update([
                'photo' => $photo->storeAs('photo_identite', $filename, 'public')
            ]);
        }
    }

    /**
     * Sauvegarde certificat adhérent
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return \Illuminate\Http\Response
     */
    private function storeCertif(User $user, File $certif)
    {
        if($certif) {
            $filename = 'certif_'.$user->id.'.'.$certif->clientExtension();
            $user->update([
                'certif' => $certif->storeAs('certificats', $filename, 'public')
            ]);
        }
    }

    /**
     * Initialisation d'un mot de passe
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    private function storePassword(User $user, string $password) {
        $user->update([
            'password' => Hash::make($password)
        ]); //turn the array into a string

        Mail::to($user->email)->send(new PasswordMail($user));
    }

    /**
     * Initialisation d'un mot de passe
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    private function initPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass);
    }



}
