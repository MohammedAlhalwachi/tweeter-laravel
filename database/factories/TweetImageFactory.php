<?php

namespace Database\Factories;

use App\Models\TweetImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TweetImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TweetImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = fopen('https://picsum.photos/1280/720.jpg', 'r');
        $path = 'tweet-images/' . Str::random(40). '.jpg';
        Storage::put($path, $image);
        
        return [
            'path' => $path, 
        ];
    }
}
