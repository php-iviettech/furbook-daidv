<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Furbook\Breed::class, 5)->create()->each(function($breed) {
            $breed->cats()->saveMany(
                factory(Furbook\Cat::class, rand(5, 50))->create([
                    'breed_id' => $breed->id
                ])
            );
        });
    }
}
