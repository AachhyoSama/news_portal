<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = "news" . ' ' . $this->faker->word;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'details' => $this->faker->paragraph,
            'image' => 'post.jpg',
            'status' => $this->faker->boolean(),
            'category_id' => $this->faker->numberBetween($max = 5, $min = 1),
            'featured' => $this->faker->boolean(),
            'view_count' => $this->faker->randomNumber(),
        ];
    }
}
