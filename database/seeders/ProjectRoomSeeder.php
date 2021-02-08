<?php

namespace Database\Seeders;

use App\Models\ProjectRoom;
use Illuminate\Database\Seeder;

class ProjectRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectRoom::create(['name' => 'GW301', 'seats' => 4, 'description' => 'Deze ruimte bevindt zich op de 3e verdieping.', 'code' => 'GW301']);
        ProjectRoom::create(['name' => 'GW302', 'seats' => 5, 'description' => 'Deze ruimte bevindt zich op de 3e verdieping.', 'code' => 'GW302']);
        ProjectRoom::create(['name' => 'GW303', 'seats' => 4, 'description' => 'Deze ruimte bevindt zich op de 3e verdieping.', 'code' => 'GW303']);
        ProjectRoom::create(['name' => 'GW304', 'seats' => 4, 'description' => 'Deze ruimte bevindt zich op de 3e verdieping.', 'code' => 'GW304']);
        ProjectRoom::create(['name' => 'GW305', 'seats' => 6, 'description' => 'Deze ruimte bevindt zich op de 3e verdieping.', 'code' => 'GW305']);
        ProjectRoom::create(['name' => 'GW306', 'seats' => 7, 'description' => 'Deze ruimte bevindt zich op de 3e verdieping.', 'code' => 'GW306']);
    }
}
