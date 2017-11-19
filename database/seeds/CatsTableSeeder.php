<?php

use Illuminate\Database\Seeder;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cats')->insert([
            [
                'name' => 'Doremon',
                'date_of_birth' => date('Y-m-d'),
                'price' => 540000,
                'breed_id' => 1,
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Doremi',
                'date_of_birth' => date('Y-m-d'),
                'price' => 980500,
                'breed_id' => 1,
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Black Cat',
                'date_of_birth' => date('Y-m-d'),
                'price' => 12000000,
                'breed_id' => 2,
                'user_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
