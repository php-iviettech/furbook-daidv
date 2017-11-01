<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'PHP'],
            ['name' => '.NET'],
            ['name' => 'Java'],
            ['name' => 'Python'],
            ['name' => 'Ruby'],
            ['name' => 'C'],
            ['name' => 'C++'],
            ['name' => 'C#'],
            ['name' => 'Swift'],
            ['name' => 'Go'],
            ['name' => 'Javascript'],
        ]);
        //this is test middle
    }
}
