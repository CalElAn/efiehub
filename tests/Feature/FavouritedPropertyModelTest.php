<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\FavouritedProperty;
use App\Models\Property;

class FavouritedPropertyModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_favourited_property_belongs_to_a_property()
    {
        $property = Property::factory()->create();
        $favouritedProperty = FavouritedProperty::factory()->create(['property_id' => $property->property_id]);

        $this->assertInstanceOf('App\Models\Property', $favouritedProperty->property);
        $this->assertEquals($property->fresh(), $favouritedProperty->property);
    }
}
