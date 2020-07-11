<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
            'picture' => 'https://n8d.at/wp-content/plugins/aioseop-pro-2.4.11.1/images/default-user-image.png',
            'password' => bcrypt('123456'),
        ]);


        $user->assignRole('asesor');


        factory(App\User::class,40)->create();
    }
}
