<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    
    /** @test */
    public function a_property_knows_if_it_has_been_favourited_by_the_authenticated_user()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        
        Auth::login($user);

        $this->assertFalse($this->property->is_property_favourited_by_the_authenticated_user);

        $this->actingAs($user)->post("/properties/{$this->property->slug}/favourites", []);

        $this->assertTrue($this->property->is_property_favourited_by_the_authenticated_user);
    }
    
    /** @test */
    public function a_property_knows_if_it_has_been_reviewed_by_the_authenticated_user()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        
        Auth::login($user);

        $this->assertFalse($this->property->is_property_reviewed_by_the_authenticated_user);

        $this->actingAs($user)->post("/properties/{$this->property->slug}/reviews", ['rating' => 3.5, 'body' => 'random review string']);

        $this->assertTrue($this->property->is_property_reviewed_by_the_authenticated_user);
    }
    
    /** @test */
    public function a_property_knows_if_it_was_uploaded_by_the_authenticated_user()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        
        Auth::login($user);

        $property1 = Property::factory()->create();
        $property2 = Property::factory(['user_id' => $user->id])->create();

        $this->assertFalse($property1->does_property_belong_to_the_authenticated_user);
        $this->assertTrue($property2->does_property_belong_to_the_authenticated_user);
    }
}

