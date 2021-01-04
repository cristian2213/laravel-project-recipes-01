<?php

use App\Receta;
use Illuminate\Database\Seeder;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receta = Receta::create([
            'title' => 'Tarta de carne',

            'ingredientes' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in s',

            'preparacion' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in s',

            'imagen' => 'upload-perfiles/p7La0dJyztykFHKKEDlxO8qNsIbgxgpse3cVdXBg.jpg',

            'user_id' => '1',
            'categoria_id' => '1'
        ]);

        $receta2 = Receta::create([
            'title' => 'Guacamole',

            'ingredientes' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in s',

            'preparacion' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in s',

            'imagen' => 'upload-perfiles/8R0wKyYSLZfgdwhlFb16LiKeLvTppLPHjL5fOCb9.jpg',

            'user_id' => '1',
            'categoria_id' => '2'
        ]);
    }
}
