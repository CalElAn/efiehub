<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->user = User::factory()->create();
    } 

    /** @test */
    public function a_user_has_properties()
    {
        $property = \App\Models\Property::factory()->create(['user_id' => $this->user->id]);

        $this->assertTrue($this->user->properties->contains($property));
        $this->assertInstanceOf('App\Models\Property', $this->user->properties[0]);
    }

    /** @test */
    public function a_user_has_favourited_properties()
    {
        $favouritedProperty = \App\Models\FavouritedProperty::factory()->create(['user_id' => $this->user->id]);

        $this->assertTrue($this->user->favouritedProperties->contains($favouritedProperty));
        $this->assertInstanceOf('App\Models\FavouritedProperty', $this->user->favouritedProperties[0]);
    }

    /** @test */
    public function a_user_knows_if_it_has_favourited_a_property()
    {
        $property = \App\Models\Property::factory()->create(['user_id' => $this->user->id]);

        $this->assertFalse($this->user->isPropertyFavourited($property));

        \App\Models\FavouritedProperty::factory()->create(['user_id' => $this->user->id, 'property_id' => $property->property_id]);

        $this->assertTrue($this->user->isPropertyFavourited($property));
    }

        /** @test */
    public function a_user_knows_if_it_has_been_reviewed_by_the_authenticated_user()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        
        Auth::login($user);

        $this->assertFalse($this->user->is_user_reviewed_by_the_authenticated_user);

        $this->actingAs($user)->post("/users/{$this->user->id}/reviews", ['rating' => 3.5, 'body' => 'random review string']);

        $this->assertTrue($this->user->is_user_reviewed_by_the_authenticated_user);
    }

    /** @test */
    public function a_user_knows_if_it_is_the_authenticated_user()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userToAuthenticate = User::factory()->create();
        
        Auth::login($userToAuthenticate);

        $otherUser = User::factory()->create();

        $this->assertFalse($otherUser->is_user_the_authenticated_user);
        $this->assertTrue($userToAuthenticate->is_user_the_authenticated_user);
    }

    /** @test */
    public function a_user_can_have_reports()
    {
        $report = \App\Models\Report::factory()->create([
                        'reportable_id' => $this->user->id, 
                        'reportable_type' => 'App\Models\User'
                    ]);

        $this->assertInstanceOf('App\Models\User', $report->reportable);
        $this->assertTrue($this->user->reports->contains($report));
        $this->assertInstanceOf('App\Models\Report', $this->user->reports[0]);
    }

    /** @test */
    public function a_user_can_have_reviews()
    {
        $review = \App\Models\Review::factory()->create([
                        'reviewable_id' => $this->user->id, 
                        'reviewable_type' => 'App\Models\User'
                    ]);

        $this->assertInstanceOf('App\Models\User', $review->reviewable);
        $this->assertTrue($this->user->reviews->contains($review));
        $this->assertInstanceOf('App\Models\Review', $this->user->reviews[0]);
    }
}
