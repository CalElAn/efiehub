<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Property;
use DB;

class PropertyModelTest extends TestCase
{
    use RefreshDatabase;

    protected $property;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->property = Property::factory()->create();
    } 

    /** @test */
    public function a_property_has_features()
    {
        $feature = DB::table('Properties_PropertyFeatures_join')->insert(['property_id' => $this->property->property_id, 'feature' => 'Walled']);

        $this->assertTrue($this->property->features->contains($feature));
        $this->assertInstanceOf('App\Models\PropertyFeature', $this->property->features[0]);
    }

    /** @test */
    public function a_property_has_media()
    {
        $media = \App\Models\PropertyMedia::factory()->create(['property_id' => $this->property->property_id]);

        $this->assertTrue($this->property->media->contains($media));
        $this->assertInstanceOf('App\Models\PropertyMedia', $this->property->media[0]);
    }

    /** @test */
    public function a_property_has_a_type()
    {
        $this->assertInstanceOf('App\Models\PropertyType', $this->property->propertyType);
    }

    /** @test */
    public function a_property_has_a_user()
    {
        $this->assertInstanceOf('App\Models\User', $this->property->user);
    }

    /** @test */
    public function a_property_can_have_reports()
    {
        $report = \App\Models\Report::factory()->create([
                    'reportable_id' => $this->property->property_id, 
                    'reportable_type' => 'App\Models\Property'
                ]);

        $this->assertInstanceOf('App\Models\Property', $report->reportable);
        $this->assertTrue($this->property->reports->contains($report));
        $this->assertInstanceOf('App\Models\Report', $this->property->reports[0]);
    }

    /** @test */
    public function a_property_can_have_reviews()
    {
        $review = \App\Models\Review::factory()->create([
                    'reviewable_id' => $this->property->property_id, 
                    'reviewable_type' => 'App\Models\Property'
                ]);

        $this->assertInstanceOf('App\Models\Property', $review->reviewable);
        $this->assertTrue($this->property->reviews->contains($review));
        $this->assertInstanceOf('App\Models\Review', $this->property->reviews[0]);
    }
}

