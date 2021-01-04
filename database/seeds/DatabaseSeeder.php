<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ejecutar los seeders
        $this->call(CategoriasSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RecetaSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
