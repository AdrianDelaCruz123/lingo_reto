<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    /**
     * Muestra una lista de todos los rankings.
     */
    public function index()
    {
        // Obtiene todos los registros de la tabla 'rankings'
        $rankings = Ranking::all();
        // Retorna la vista 'rankings.index' pasando los datos obtenidos
        return view('rankings.index', ['rankings' => $rankings]);
    }
    /**
     * Muestra la lista de rankings pero con un estilo diferente.
     */
    public function indexStyled()
    {
    // Obtiene todos los registros de la tabla 'rankings'
        $rankings = Ranking::all();
        // Retorna la vista 'rankings.indexStyled' (versión con otro diseño)
        return view('rankings.indexStyled', ['rankings' => $rankings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ranking $ranking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ranking $ranking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ranking $ranking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ranking $ranking)
    {
        //
    }
}
