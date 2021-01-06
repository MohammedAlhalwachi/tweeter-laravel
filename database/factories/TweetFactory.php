<?php

namespace Database\Factories;

use App\Models\Tweet;
use App\Models\TweetImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tweet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = now()->subDays(random_int(0, 5))->subHours(random_int(0, 24));
        
        return [
            'body' => $this->faker->text(280),
            'created_at' => $date,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Tweet $tweet) {
            $images = [];
            
            for ($i = 0; $i < random_int(0, 4); $i++) 
                $images[] = TweetImage::factory()->make();
            
            $tweet->images()->saveMany($images);
        });
    }
}
