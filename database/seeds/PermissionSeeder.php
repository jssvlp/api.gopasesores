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
        Permission::create(['name' =>'Crear empleados','action' =>'create','path' =>'employees']);
        Permission::create(['name' =>'Modificar empleados','action' =>'update','path' =>'employees']);
        Permission::create(['name' =>'Borrar empleados','action' =>'delete','path' =>'employees']);
        Permission::create(['name' =>'Ver todos los empleados','action' =>'all','path' =>'employees']);
        Permission::create(['name' =>'Ver detalle de empleados','action' =>'detail','path' =>'employees']);

        Permission::create(['name' =>'Crear clientes','action' =>'create','path' =>'clients']);
        Permission::create(['name' =>'Modificar clientes','action' =>'update','path' =>'clients']);
        Permission::create(['name' =>'Borrar clientes','action' =>'delete','path' =>'clients']);
        Permission::create(['name' =>'Ver todos los clientes','action' =>'all','path' =>'clients']);
        Permission::create(['name' =>'Ver detalle de clientes','action' =>'detail','path' =>'clients']);
        //Api permisions

    }
}
