<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // crear seeder usando modelo
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'url' => 'https://polar-waters-50211.herokuapp.com',
        ]);

        // el evento en el modelo ejecuta la creacion de perfiles, por eso se comentan en este semillero


        // crear seeder usando modelo
        $user2 = User::create([
            'name' => 'Cristian',
            'email' => 'cristian@gmail.com',
            'password' => Hash::make('admin123'),
            'url' => 'https://polar-waters-50211.herokuapp.com',
        ]);


        // los seeders son datos que queremos guardar en la db por defecto
        // DB::table('users')->insert([
        //     'name' => 'Cristian',
        //     'email' => 'admin@admin.com',
        //     'url' => 'https://polar-waters-50211.herokuapp.com',
        //     'password' => Hash::make('admin123'),
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
    }
}
