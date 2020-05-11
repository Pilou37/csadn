<?php

namespace App\Http\Controllers;

use App\Reglement;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ReglementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglements = Reglement::with(['user','mode'])
        ->get();

        return view('reglement.liste')->with('reglements', $reglements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $reglements = Reglement::where('user_id', $user->id)->get();

        return view('reglement.form', compact('user', 'reglements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator();

        $reglement = Reglement::create($data);

        return redirect()->route('reglement.create',$reglement->user)->with('success', 'Règlement créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Reglement $reglement)
    {
        $reglements = Reglement::where('user_id', $user->id)->get();

        return view('reglement.form', compact('user', 'reglements', 'reglement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reglement $reglement)
    {
        $data = $this->validator();

        $reglement->fill($data);

        $reglement->save();

        return redirect()->route('reglement.create',$reglement->user)->with('success', 'Règlement mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reglement $reglement)
    {
        if(Gate::allows('comptabilite')) {
            $reglement->delete();
            return redirect()->route('reglement.index')->with('success', 'Règlement supprimé');
        }
        else
        {
            return $this->unauthorized();
        }
    }

    /**
     * Filtres pour validation reglements et mise à jour
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function validator() {
        return request()->validate([
            'user_id'          => 'required|integer',
            'nr_recu'       => 'required|integer',
            'mode'          => 'required|string|in:cheque,espece,caf,coupon,autre',
            'valeur'        => 'required|integer'
        ]);
    }
}
