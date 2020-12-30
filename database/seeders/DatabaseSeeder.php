<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()
                        ->has(
                            Tweet::factory()->count(5)
                        )
                        ->create([
                            'name' => 'Mohammed Alhalwachi',
                            'username' => 'malhalwachi',
                            'email' => 'alhalwachi@gmail.com',
                            'password' => Hash::make('alhalwachi@gmail.com'),
                        ]);
        
        \App\Models\User::factory(3)
                        ->has(
                            Tweet::factory()->count(3)
                        )
                        ->create();
    }
}
