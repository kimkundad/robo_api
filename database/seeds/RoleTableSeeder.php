<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
            'name' => 'manager',
            'description' => 'A manager User'
            ],
            [
              'name' => 'employee',
              'description' => 'A employee User'
            ],
            [
              'name' => 'customer',
              'description' => 'A customer User'
            ]
        ]);
    }
}
