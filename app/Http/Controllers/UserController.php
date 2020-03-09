<?php

namespace App\Http\Controllers;

use App\Mail\SuscribeMail;
use App\Rules\Telephone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('activite')->get();

        return view('user.liste')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($this->validator());
        $this->storePhoto($user);
        $this->storeCertif($user);
        $this->initPassword($user);

        Mail::to('test@test.com')->send(new SuscribeMail($user));

        //$request->session()->flash('success', 'C\'est un succès');

        return redirect('user')->with('success', 'Adhérent créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.form')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('user');
    }

    private function validator() {
        return request()->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'naissance_at' => 'required',
            'naissance_lieu' => 'required',
            'adresse' => 'required',
            'cp' => 'required',
            'ville' => 'required',
            'tel' => ['required', new Telephone],
            'email' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,jpg,png,jpg,gif,svg|max:5000',
            'certif' => 'sometimes|file',
            'certif_at' => 'required',
            'activite_id' => 'required',
            'origine' => 'required'
        ]);
    }

    private function storePhoto(User $user)
    {
        if(request('photo')) {
            $filename = 'ident_'.$user->id.'.'.request('photo')->clientExtension();
            $user->update([
                'photo' => request('photo')->storeAs('photo_identite', $filename, 'public')
            ]);
        }
    }

    private function storeCertif(User $user)
    {
        if(request('certif')) {
            $filename = 'certif_'.$user->id.'.'.request('certif')->clientExtension();
            $user->update([
                'certif' => request('certif')->storeAs('certificats', $filename, 'public')
            ]);
        }
    }

    private function initPassword(User $user) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $user->update([
            'password' => implode($pass)
        ]); //turn the array into a string
    }
}
