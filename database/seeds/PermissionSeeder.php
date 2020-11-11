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
        Permission::create(['name' =>'Crear empleados','action' =>'create','path' =>'/employees']);
        Permission::create(['name' =>'Modificar empleados','action' =>'update','path' =>'/employees']);
        Permission::create(['name' =>'Borrar empleados','action' =>'delete','path' =>'/employees']);
        Permission::create(['name' =>'Ver todos los empleados','action' =>'all','path' =>'/employees']);
        Permission::create(['name' =>'Ver detalle de empleados','action' =>'detail','path' =>'/employees']);

        Permission::create(['name' =>'Crear clientes','action' =>'create','path' =>'/clients']);
        Permission::create(['name' =>'Modificar clientes','action' =>'update','path' =>'/clients']);
        Permission::create(['name' =>'Borrar clientes','action' =>'delete','path' =>'/clients']);
        Permission::create(['name' =>'Ver todos los clientes','action' =>'all','path' =>'/clients']);
        Permission::create(['name' =>'Ver detalle de clientes','action' =>'detail','path' =>'/clients']);


        Permission::create(['name' =>'ver seguridad','action' =>'all','path' =>'/security']);
        Permission::create(['name' =>'ver aseguradoras','action' =>'all','path' =>'/insurances']);
        Permission::create(['name' =>'agregar rol','action' =>'create','path' =>'/security']);
        Permission::create(['name' =>'borrar rol ','action' =>'delete','path' =>'/security']);
        Permission::create(['name' =>'ver roles','action' =>'detail','path' =>'/security']);

        Permission::create(['name' =>'editar aseguradora','action' =>'update','path' =>'/insurances']);
        Permission::create(['name' =>'borrar aseguradora','action' =>'delete','path' =>'/insurances']);
        Permission::create(['name' =>'crear aseguradora','action' =>'create','path' =>'/insurances']);

        Permission::create(['name' =>'Ver dashboard','action' =>'all','path' =>'/dashboard']);
        Permission::create(['name' =>'Ver polizas','action' =>'all','path' =>'/polices']);
        Permission::create(['name' =>'Ver siniestros','action' =>'all','path' =>'/sinisters']);
        //Api permisions

    }
}
