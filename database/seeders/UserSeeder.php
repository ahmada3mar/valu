<?php

namespace Database\Seeders;

use Hyperpay\ConnectIn\Models\Merchant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => env('NOVA_PERMISSION_ADMIN_EMAIL', 'admin@hyperpay.com')
            ],
            [
                'name' => 'admin',
                'password' => bcrypt('123456')
            ]
        );

        Merchant::updateOrCreate(
            [
                'authentication_entityId' => env('MERCHANT_ID', '1111111kkkk'),
                'access_token' => env('MERCHANT_TOKEN', 'OGE4Mjk0MTg1ZjExNmU4NjAxNWYyM2VkZjE0ZTFmODB8N0VkUURlc3NLUA=='),
                'authentication_userId' => env('MERCHANT_USER_ID', '2222qqqq'),
            ],
            [
                'name' => 'merchent',
                'email' => 'merchent@hyperpay.com',
                'authentication_password' => env('MERCHANT_USER_PASSWORD', '123456'),
                'aci_secret' => env('MERCHANT_ACI_SECRET', 'secret'),
                'created_by' => 1,
            ]
        );
    }
}
