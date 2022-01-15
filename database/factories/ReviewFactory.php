<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'reviewable_id' => '',
            'reviewable_type' => '',
            // 'rating' => $this->faker->numberBetween(1, 5),
            'rating' => 4.7, //later find way to make faker generate a double with 1 dp between 1 to 5
            'review' => $this->faker->paragraphs(1, true) 
        ];
    }
}
