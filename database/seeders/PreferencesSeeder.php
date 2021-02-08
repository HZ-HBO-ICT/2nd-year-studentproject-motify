<?php

namespace Database\Seeders;

use App\Models\Preferences;
use Illuminate\Database\Seeder;

class PreferencesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Preferences::create([
            'id' => 1,
            'hue_client_id' => 'LrbSIn351FyZ8cSPrtz9vTmc5ocNYzkb',
            'hue_client_secret' => 'MPxkGPjSTXkGOC5L',
            'hue_device_id' => 'ecb5fafffe2d1cdf',
            'hue_username' => 'p1Te3Qtuz8iKFMezbQ53P3y8R-JCf8rE3ZOTS6s9',
            'hue_access_token' => 'MnkPvn7Gf22ihLMFSrvXDAvOnadw',
            'hue_access_token_expires_at' => '2020-12-17 10:51:59',
            'hue_access_token_expires_in' => "604799",
            'hue_refresh_token' => 'y0Lc5tHUECTJRPxZYX2oyTi2NkKGtbar',
            'hue_refresh_token_expires_at' => '2021-04-01 10:51:59',
            'hue_refresh_token_expires_in' => '9676799',
        ]);
    }
}

