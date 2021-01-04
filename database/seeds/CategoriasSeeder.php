<?php

use App\CategoriaReceta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // los seeders son datos que queremos guardar en la db por defecto
        CategoriaReceta::create([
            'nombre' => 'Comida Mexicana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        CategoriaReceta::create([
            'nombre' => 'Comida Italiana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        CategoriaReceta::create([
            'nombre' => 'Comida Argentina',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        CategoriaReceta::create([
            'nombre' => 'Postres',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        CategoriaReceta::create([
            'nombre' => 'Cortes',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        CategoriaReceta::create([
            'nombre' => 'Ensaladas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        CategoriaReceta::create([
            'nombre' => 'Desayunos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        /* DB::table('categoria_recetas')->insert([
            'nombre' => 'Comida Mexicana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
            'nombre' => 'Comida Italiana',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
            'nombre' => 'Comida Argentina',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_recetas')->insert([
            'nombre' => 'Postres',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
            DB::table('categoria_recetas')->insert([
                'nombre' => 'Cortes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                ]);
                
                DB::table('categoria_recetas')->insert([
                    'nombre' => 'Ensaladas',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    
                    DB::table('categoria_recetas')->insert([
                        'nombre' => 'Desayunos',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        ]);
        */
    }
}
