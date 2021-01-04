<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    // relacion 1:1 inversa, obtener usuario del perfil (fk)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
