<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Web permisions
        Permission::create(['name' =>'create employees','action' =>'create','path' =>'employees']);
        Permission::create(['name' =>'update employees','action' =>'update','path' =>'employees']);
        Permission::create(['name' =>'delete employee','action' =>'delete','path' =>'employees']);
        Permission::create(['name' =>'all employees','action' =>'all','path' =>'employees']);
        Permission::create(['name' =>'detail employees','action' =>'detail','path' =>'employees']);

        Permission::create(['name' =>'create clients','action' =>'create','path' =>'clients']);
        Permission::create(['name' =>'update clients','action' =>'update','path' =>'clients']);
        Permission::create(['name' =>'delete clients','action' =>'delete','path' =>'clients']);
        Permission::create(['name' =>'all clients','action' =>'all','path' =>'clients']);
        Permission::create(['name' =>'detail clients','action' =>'detail','path' =>'clients']);
        //Api permisions

    }
}
