<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' =>'asesor']);
        Role::create(['name' =>'secretaria']);
        Role::create(['name' =>'admin']);
        Role::create(['name' =>'socio']);
        Role::create(['name' =>'vendedor']);
        Role::create(['name' =>'cliente']);


        $role = Role::findById(1);
        $permisions = Permission::all();

        $role->givePermissionTo($permisions);
    }
}
