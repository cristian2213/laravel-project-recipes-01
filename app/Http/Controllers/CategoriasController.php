<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaReceta $categoriaReceta)
    {
        //* relacion en el modelo
        //$recetas = $categoriaReceta->recetasCategoria;

        $recetas = Receta::where('categoria_id', $categoriaReceta->id)->paginate(2);

        return view('categorias.show', compact('recetas', 'categoriaReceta'));
    }
}
