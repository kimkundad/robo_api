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
              'name' => 'I Am Admin',
              'email' => 'admin@email.com',
              'first_name' => 'kim',
              'last_name' => 'kundad',
              'phone' => '0958467417',
              'password' => bcrypt('12345678'),
              'code_user' => 'UD123456',
              'avatar' => '1483537975.png',
              'email_verified_at' => '2020-08-01 14:27:38',
              'provider' => 'email'
            ],
            [
              'name' => 'thewealthangels',
              'email' => 'thewealthangels@gmail.com',
              'first_name' => 'kim',
              'last_name' => 'kundad',
              'phone' => '0958467417',
              'password' => bcrypt('12345678'),
              'code_user' => 'UD123456',
              'avatar' => '1483537975.png',
              'email_verified_at' => '2020-08-01 14:27:38',
              'provider' => 'email'
            ]
        ]);
    }
}
