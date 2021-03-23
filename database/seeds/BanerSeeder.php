<?php

use Illuminate\Database\Seeder;

class BanerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
            'name' => 'ชำระเงิน 1',
            'image' => 'ThaiQR-Logo.png',
            'sort' => 1
            ],
            [
            'name' => 'ชำระเงิน 2',
            'image' => 'Visa-logo.png',
            'sort' => 2
            ],
            [
            'name' => 'ชำระเงิน 3',
            'image' => '300px-Mastercard-logo.svg.png',
            'sort' => 3
            ],
            [
            'name' => 'ชำระเงิน 4',
            'image' => 'Alipay-logo.png',
            'sort' => 4
            ],
            [
            'name' => 'ชำระเงิน 5',
            'image' => 'WeChat-Logo.png',
            'sort' => 5
            ],
            [
            'name' => 'ชำระเงิน 6',
            'image' => 'TrueMoney-Logo.png',
            'sort' => 6
            ],
            [
            'name' => 'ชำระเงิน 7',
            'image' => 'LINE-Pay(h)_W238_n.png',
            'sort' => 7
            ],
            [
            'name' => 'ชำระเงิน 8',
            'image' => 'mPay-Logo.png',
            'sort' => 8
            ],
            [
            'name' => 'ชำระเงิน 9',
            'image' => 'Dolfin-Logo.png',
            'sort' => 9
            ],
            [
            'name' => 'ชำระเงิน 10',
            'image' => 'VIA-Logo.png',
            'sort' => 10
            ]
        ]);
    }
}
