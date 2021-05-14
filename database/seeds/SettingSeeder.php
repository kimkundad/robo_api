<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
            'nme_website' => 'wealthangels',
            'facebook' => 'Wealthangels',
            'facebook_url' => 'https://www.facebook.com/wealthangels',
            'facebook' => 'Wealthangels',
            'facebook_image' => '1607528770.jpg',
            'phone' => '0958467417',
            'email' => 'thewealthangels@gmail.com'
            ]
        ]);
    }
}
