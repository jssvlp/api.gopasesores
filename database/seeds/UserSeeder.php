<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'jossias.vel@gmail.com',
            'status' => 'Activo',
            'username' =>'josha',
            'password' => bcrypt('123456'),
        ]);


        factory(App\User::class,40)->create();
    }
}
