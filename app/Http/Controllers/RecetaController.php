<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        //* autenticar las rutas
        //$this->middleware('auth')->except('show');
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->recetas->dd();
        //$recetas = auth()->user()->recetas; // recetas es la relacion en el modelo

        // recetas con paginacion
        $user = auth()->user()->id;
        $recetas = Receta::where('user_id', $user)->paginate(10);
        return view('recetas.index', compact('recetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // consultar la db con un facade
        // pluck -> se piden los datos que se desean

        //DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();

        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id'); //* obtener datos sin modelo

        //* obtener datos con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // mostrar informacion exclusiva de la peticion
        //dd($request->all());
        //dd($request->all());

        $data = request()->validate([
            'title' => 'required|min:2',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required',
        ]); // asigna los datos de la peticion y el validate es un meto que hace parte de la peticion

        // get the image path, ultil here the image is upload
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public'); // params: 1. carpeta en la cual se va a guardar las imagenes, 2. en la carpeta en donde se va a guardar todo.

        // image resize 
        // public_path -> ruta hacia la carpeta publica (enlace simbolico)
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550); // ajustar el tamaño de la imagen

        $img->save(); // guardar en el disco duro del servidor

        //Facades: funciones que pueden ser muy complejas que laravel hace automaticamente, almacenar en la db sin modelo

        //DB::table('recetas')->insert([
        //    'title' => $data['title'],
        //    'ingredientes' => $data['ingredientes'],
        //    'preparacion' => $data['preparacion'],
        //    'imagen' => $ruta_imagen,
        //    /* helper para save que usuario esta autenticado */
        //    'user_id' => Auth::user()->id,
        //    'categoria_id' => $data['categoria'],
        //]);

        // guardar con modelo
        auth()->user()->recetas()->create([
            'title' => $data['title'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);


        // redirec
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     * Here it is used Route Model Binding
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     * se removio el Route Model Binding, y se esta usando el metodo find or findOrfail
     */
    public function show(Receta $receta)
    {
        //$receta = Receta::findOrFail($receta);
        /* $receta = Receta::find($receta);
        if (!$receta) {
            return redirect()->action('RecetaController@index');
        } */

        // obtener si el usuario actal le gusta la receta y esta autenticado
        // contains: si se le pasa una id identifica si esa id existe en los megustas

        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;


        // pasa la cantidad de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {

        // Block users that try enter to edit other recipe
        $this->authorize('view', $receta);

        //* obtener datos con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.edit', compact('categorias', 'receta'));
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
        // implementing policy
        // Authorize a given action for the current user.
        $this->authorize('update', $receta);

        // validate fields
        $data = request()->validate([
            'title' => 'required|min:2',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'categoria' => 'required',
        ]);

        // update image
        if (request('imagen')) {
            // get the image path
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            // image resize 
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550); // abrir el archivo de la imagen

            // save image
            $img->save();

            // assign to the object
            $receta->imagen = $ruta_imagen;
        }


        // assign values
        $receta->title = $data['title'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];

        // save new data
        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        // using a policy
        $this->authorize('delete', $receta);

        $receta->delete(); //other methods for delete
        //Receta::destroy($receta);
        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request)
    {
        $data = request()->validate([
            'buscar' => 'required'
        ]);

        // buscar en la db con el like
        $recetas = Receta::where('title', 'like', '%' . $data['buscar'] . '%')->paginate(6);

        $recetas->appends($data['buscar']);

        if (!$recetas[0]) {
            return redirect()->route('inicio.index');
        }

        return view('busquedas.show', compact('recetas', 'data'));
    }
}
