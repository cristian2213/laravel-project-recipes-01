<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /// * Evento que se ejecuta cuando un usuario es creado
    protected static function booted()
    {
        parent::booted();

        // asignar perfil cuando un usuario es creado
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    /** Relacion 1:n de Usuario a Recetas 
     * Un usuario puede tener muchas recetas
     * Getting the recipes thant an user created
     */
    public function recetas()
    {
        /* 
          1:1 -> hasOne
          1:n -> hasMany
          n:n -> belongsToMany
        */

        return $this->hasMany(Receta::class, 'user_id');
    }

    /* Relacion de 1:1, obtener perfil del usuario */
    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'user_id');
    }

    // obtener las recetas que el usuario le ha dado megusta (n:n)
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}
