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
        $image = $this->getRandomImageStream();
        $path = 'tweet-images/' . Str::random(40) . '.jpg';
        Storage::put($path, $image);

        return [
            'path' => $path,
        ];
    }

    private function getRandomImageStream()
    {
        //$imageStream = fopen('https://picsum.photos/1280/720.jpg', 'r');
        
        $folderPath = Storage::disk('local')->path('testing/tweet-images/');
        $images = glob($folderPath . '*.{jpg,jpeg,png}', GLOB_BRACE);

        $randImagePath = $images[array_rand($images)];
        $imageStream = fopen($randImagePath, 'r');

        return $imageStream;
    }
}
