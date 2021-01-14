<?php

namespace App\Providers;

use View;
use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     * se colocan las dependencias que se van a utilizar al ejecutar el proyecto
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * se ejecuta todo cuando la app esta lista
     * @return void
     */
    public function boot()
    {
        // pasar categorias a la vista
        View::composer('*', function ($view) {

            $categorias = CategoriaReceta::all();
            $view->with('categorias', $categorias);
        });
    }
}
