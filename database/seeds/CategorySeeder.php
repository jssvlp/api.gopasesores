<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category();
        $category->name = 'Educación';
        $category->color = 'blue';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Finanzas';
        $category->color = 'blue';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Tecnología';
        $category->color = 'blue';
        $category->save();
    }
}
