<?php

namespace Database\Seeders;

use App\Models\Tweet;
use App\Models\User;
use App\Scopes\WithMetadata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::disableQueryLog();

        $myAccount = User::factory()
            ->create([
                'name' => 'Mohammed Alhalwachi',
                'username' => 'malhalwachi',
                'email' => 'alhalwachi@gmail.com',
                'password' => Hash::make('alhalwachi@gmail.com'),
            ]);

        $demoAccounts = [
            User::factory()
                ->create([
                    'name' => 'Flossie Haley',
                    'username' => 'adan.bartoletti',
                    'email' => 'jeffrey34@example.net',
                ]),
            User::factory()
                ->create([
                    'name' => 'Logan Bauch',
                    'username' => 'ygottlieb',
                    'email' => 'lourdes65@example.org',
                ]),
            User::factory()
                ->create([
                    'name' => 'Ruth Olson',
                    'username' => 'haley.graciela',
                    'email' => 'ilegros@example.org',
                ]),
        ];

        $users = User::factory()
            ->count(80)
            ->create()
            ->merge($demoAccounts)
            ->push($myAccount);

        $tweets = Tweet::withoutGlobalScope(WithMetadata::class)->take(200)->get();

        foreach ($users as $user) {
            for ($i = 0; $i < random_int(13, 20); $i++){
                //follow another user
                $otherUser = $users->random();
                while ($otherUser->is($user)) $otherUser = $users->random();
                $user->follow($otherUser);

                //like tweet
                $tweet = $tweets->random();
                $user->like($tweet);
                //bookmark tweet
                $tweet = $tweets->random();
                $user->bookmark($tweet);
            }
            
            for ($i = 0; $i < random_int(0, 2); $i++){
                //retweet tweet
                $tweet = $tweets->random();
                $user->retweet($tweet);
            }
        }

        DB::enableQueryLog();
    }
}
