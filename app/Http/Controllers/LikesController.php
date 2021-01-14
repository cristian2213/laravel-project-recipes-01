<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // toggle es un metod que esta compuesto por attached,    detached lo cual permite que al momento de dar click en el componente de Vue va a venir a este metodo del controlador y toggle comprueba si ya hay un registro en la db, si lo hay entonces lo elimina y sino entonces lo crea.
        return auth()->user()->meGusta()->toggle($receta);
    }
}
