<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

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

        dd($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
            'tel' => 'required',
            'email' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,jpg,png,jpg,gif,svg|max:5000',
            'certif' => 'sometimes|file',
            'certif_at' => 'required',
            'activite' => 'required',
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
}
