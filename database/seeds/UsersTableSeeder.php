<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'daidv',
                'email' => 'daidv@rikkeisoft.com',
                'password' => bcrypt('123456'),
                'is_admin' => false
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'is_admin' => true
            ]
        ]);
    }
}
