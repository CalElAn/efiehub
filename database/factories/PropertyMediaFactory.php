<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => Property::factory(),
            'path' => 'https://picsum.photos/405/384',
            'mime_type' => 'image/jpeg',
            'extension' => 'jpg',
            'size_in_bytes' => 695, //random number
            'formatted_size' => '695 bytes', //random number
        ];
    }
}
