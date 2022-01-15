<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'body' => $this->faker->paragraphs(3, true), 
            'reportable_id' => '',
            'reportable_type' => '',
        ];
    }
}
