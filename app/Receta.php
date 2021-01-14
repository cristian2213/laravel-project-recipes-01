<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    // campos que se agregaran
    protected $fillable = ['title', 'ingredientes', 'preparacion', 'imagen', 'categoria_id'];

    // obtiene la categoria de la receta via FK (1:1)
    /* 
        1:1 -> belongsTo
        1:n -> belongsTo
        n:n -> belongsToMany
    */
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    // get the user (user_id) of the recipe 
    public function autor()
    {
        // reference to the FK
        return $this->belongsTo(User::class, 'user_id');
    }

    // obtener los usuario que le han dado like a una misma receta (n:n)
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
