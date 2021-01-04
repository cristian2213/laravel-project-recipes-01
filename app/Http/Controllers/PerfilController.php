<?php

namespace App\Http\Controllers;

use App\User;
use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth')->except('show');
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        // get recipes with paginate
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(10);


        // show an only profile
        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        // Block users that try enter to edit other profile
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        $this->authorize('update', $perfil);

        // validate form
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required',
        ]);

        // check if the user upload a new image
        if (request('imagen')) {
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            // resize img
            $img = Image::make(public_path("/storage/{$ruta_imagen}"))->fit(600, 600);

            $img->save();

            $array_imagen = ['imagen' => $ruta_imagen];
        }


        /* 
        Es lo mismo que auth()->user()->name = $data['nombre'];
        $user = User::find($perfil->usuario);
        $user->name = $request['name'];
        $user->save();
        */
        // update name and url of the user
        auth()->user()->name = $data['nombre'];
        auth()->user()->url = $data['url'];
        auth()->user()->save();

        // eliminar url y nombre de la variable para actualizar perfil 
        unset($data['nombre']);
        unset($data['url']);

        /* 

        Operador de fusión de null -> (??)

        / Obntener el valor de $_GET['usuario'] y devolver 'nadie'

        / si no existe.
        $nombre_usuario = $_GET['usuario'] ?? 'nadie';

        / Esto equivale a:
        $nombre_usuario = isset($_GET['usuario']) ? $_GET['usuario'] : 'nadie';
            
        */

        // update biography and image
        // array_merge: permite unir dos arrays asociativos
        auth()->user()->perfil()->update(array_merge($data, $array_imagen ?? []));

        /* array_merge()
            {
              "biografia": "<div>this a biography</div>",
              "imagen": "upload-perfiles/h6u1dTVojPsGG38CuZzMQsW2ePR2vvX1s77pZ9uk.jpg"
            }
        */

        // redirect
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
