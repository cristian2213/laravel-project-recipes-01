<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        /*      $recetas = Receta::orderBy('id', 'desc')->limit(5)->get(); */
        $lastestRecipes = Receta::latest()->take(6)->get(); //* obtener las recetas más nuevas

        //* obtener todas las categorias
        $categories = CategoriaReceta::all();
        $recipesByCategory = [];

        //* agrupar recetas por categoria
        foreach ($categories as $category) {
            // se crea la propiedad con el nombre de la categoria y un "array" en el cual se van a agregar todas las recetas que correspondan con la categoria
            $recipesByCategory[Str::slug($category->nombre)][] =  Receta::where('categoria_id', $category->id)->take(3)->get();
        }

        //* Mostrar las recetas por cantidad de votos (sumar los likes de casa receta)
        //$votadas = Receta::has('likes', '>', 1)->get(); //likes es la relacion en el modelo Receta

        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get(); // agrega una columna nueva con el numero de likes

        return view('inicio.index', compact('lastestRecipes', 'recipesByCategory', 'votadas'));
    }
}
