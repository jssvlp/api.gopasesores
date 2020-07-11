<?php

use App\Route;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Route::create('employees');
        Route::create('dashboard');
        Route::create('clients');
    }
}
