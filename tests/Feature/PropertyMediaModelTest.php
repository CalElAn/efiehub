<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\PropertyMedia;
use App\Models\Property;

class PropertyMediaModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_property_media_belongs_to_a_property()
    {
        $property = Property::factory()->create();
        $propertyMedia = PropertyMedia::factory()->create(['property_id' => $property->property_id]);

        $this->assertInstanceOf('App\Models\Property', $propertyMedia->property);
        $this->assertEquals($property->fresh(), $propertyMedia->property);
    }
}
