<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $regionData = DB::table('regions')
                        ->pluck('name')->toArray();


        return [
            'user_id' => User::factory(),
            'unit_number' => $this->faker->randomDigitNotNull(),
            'region' => $regionData[ array_rand($regionData) ],
            'city' => $this->faker->state(),
            'town' => $this->faker->streetName(),
            'address' => $this->faker->address(),
            'gps_location' => $this->faker->latitude().','.$this->faker->longitude(),
            'type' => 'Apartment', //hardcode Apartment for now
            'other_features' => $this->faker->paragraphs(3),
            'price' => $this->faker->randomNumber(4, false),
            'is_rent_negotiable' => $this->faker->numberBetween(0, 1),
            'advance' => $this->faker->numberBetween(0, 3),
            'is_advance_negotiable' => $this->faker->numberBetween(0, 1),
            'contact_phone_number' => $this->faker->randomNumber(9, true),
            'contact_email' => $this->faker->email(),
            'is_property_available' => $this->faker->numberBetween(0, 1),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];
    }
}
