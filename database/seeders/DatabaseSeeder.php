<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectRoomSeeder::class);
        $this->call(PreferencesSeeder::class);
        User::create([
            'first_name' => 'Levi',
            'last_name' => 'Deurloo',
            'email' => "levimbg@gmail.com",
            'avatar' => 'https://avatars2.githubusercontent.com/u/46893093?s=460&v=4',
            'email_verified_at' => now(),
            'password' => Hash::make("admin"),
            'is_buddy' => (boolean)true,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'first_name' => 'Danny',
            'last_name' => 'Lifino',
            'email' => "dannylif@hotmail.com",
            'avatar' => 'https://avatars0.githubusercontent.com/u/33070880?s=460&u=1a6b6adc0d0a63f16fc39d298ff9c7c76d4ea69c&v=4',
            'email_verified_at' => now(),
            'password' => Hash::make("admin"),
            'is_buddy' => (boolean)true,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'first_name' => 'Mart',
            'prefix' => 'de',
            'last_name' => 'Jager',
            'avatar' => 'https://nyc3.digitaloceanspaces.com/memecreator-cdn/media/__processed__/e4c/template-mocking-spongebob-0c6db91aec9c.jpg',
            'email' => "jage0030@hz.nl",
            'email_verified_at' => now(),
            'password' => Hash::make("admin"),
            'is_buddy' => (boolean)true,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'first_name' => 'Mariska',
            'last_name' => 'Harnam',
            'avatar' => 'https://i.pinimg.com/280x280_RS/23/fa/0c/23fa0c006f03ee6155c17e5b272c4acf.jpg',
            'email' => "harn0005@hz.nl",
            'email_verified_at' => now(),
            'password' => Hash::make("admin"),
            'is_buddy' => (boolean)true,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'first_name' => 'Angelique',
            'last_name' => 'Huige',
            'avatar' => 'https://nyc3.digitaloceanspaces.com/memecreator-cdn/media/__processed__/e4c/template-mocking-spongebob-0c6db91aec9c.jpg',
            'email' => "ajbhuige@outlook.com",
            'email_verified_at' => now(),
            'password' => Hash::make("admin"),
            'is_buddy' => (boolean)true,
            'remember_token' => Str::random(10)
        ]);
    }
}
