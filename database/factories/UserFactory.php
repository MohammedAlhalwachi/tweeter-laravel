<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $profileImage = fopen('https://picsum.photos/1280/720.jpg', 'r');
        $profileImagePath = 'tweet-images/' . Str::random(40). '.jpg';
        Storage::put($profileImagePath, $profileImage);

        $profileBanner = fopen('https://picsum.photos/1280/720.jpg', 'r');
        $profileBannerPath = 'tweet-images/' . Str::random(40). '.jpg';
        Storage::put($profileBannerPath, $profileBanner);
        
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'description' => $this->faker->text,
            'email' => $this->faker->unique()->safeEmail,
            'profile_photo_path' => $profileImagePath,
            'profile_banner_path' => $profileBannerPath,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
