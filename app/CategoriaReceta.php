<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaReceta extends Model
{
    // obtener las recetas de una categoria

    function recetasCategoria()
    {
        return $this->hasMany(Receta::class, 'categoria_id');
    }
}
