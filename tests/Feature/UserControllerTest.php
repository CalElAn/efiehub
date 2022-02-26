<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\FavouritedProperty;
use App\Models\PropertyMedia;
use App\Models\Article;

use Illuminate\Support\Facades\DB;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_shown()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'user' => $user->load('reviews'),
            'paginatedProperties' => $user->getPaginatedProperties(url()->current().'?category=paginatedProperties'),
            'reviews' => $user->reviews,
            'paginatedFavouritedProperties' => $user->getPaginatedFavouritedProperties(url()->current().'?category=paginatedFavouritedProperties'),
            'notifications' => $user->notifications,
        ]);
    }

    /** @test */
    public function the_page_to_edit_a_user_can_be_shown()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/users/{$user->id}/edit");
        $response->assertStatus(200); 
        $response->assertViewHasAll([
            'user' => $user
        ]);

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userWhoIsNotAuthenticated = User::factory()->create();
        $this->actingAs($userWhoIsNotAuthenticated)->get("/users/{$user->id}/edit")->assertStatus(403);
    }
    
    /** @test */
    public function a_user_can_be_updated()
    {
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $input = [
            'name' => 'changed name',
            'email' => 'email@changed.com',
            'phone_number' => 'changed phone_number',           
        ];

        $response = $this->actingAs($user)->patch("/users/{$user->id}", $input);

        $response->assertRedirect("/users/{$user->id}");

        $this->assertDatabaseHas('users', [
            'name' => 'changed name',
            'email' => 'email@changed.com',
            'phone_number' => 'changed phone_number',           
        ]);
    }

    /** @test */
    public function a_user_can_favourite_a_property()
    {
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $property = Property::factory()->create();

        $this->actingAs($user)->post("/properties/{$property->slug}/favourites", []);

        $this->assertDatabaseHas('favourited_properties', ['user_id' => $user->id, 'property_id' => $property->property_id]);
    }

    /** @test */
    public function a_user_can_unfavourite_a_property()
    {
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $property = Property::factory()->create();

        $this->actingAs($user)->post("/properties/{$property->slug}/favourites", []);

        $this->actingAs($user)->post("/properties/{$property->slug}/favourites", []);

        $this->assertDatabaseMissing('favourited_properties', ['user_id' => $user->id, 'property_id' => $property->property_id]);
    }

    /** @test */
    public function a_user_can_request_call_back()
    {
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $user2 = User::factory()->create(); 

        $this->actingAs($user)->post(
            "/users/{$user2->id}/request-call-back", 
            $input = ['user_id' => $user->id, 'phoneNumber' => '0244233402']
        );

        $this->assertDatabaseHas(
            'notifications', 
            [
            'type' => 'App\Notifications\CallBackRequested', 
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => $user2->id,
            'data' => json_encode(['user_id' => $user->id, 'phone_number' => '0244233402'])
            ]
        );
    }

    /** @test */
    public function a_user_can_be_reviewed()
    {
        $input = [
            'rating' => 3.5,
            'body' => 'random review string'
        ];

        $userToBeReviewed = User::factory()->create();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userToMakeTheReview = User::factory()->create();
        $this->actingAs($userToMakeTheReview)->post("/users/{$userToBeReviewed->id}/reviews", $input)->assertStatus(201);

        $this->assertDatabaseHas('reviews', [
                                            'user_id' =>$userToMakeTheReview->id,
                                            'rating' => $input['rating'],
                                            'review' => $input['body'],
                                            'reviewable_id' => $userToBeReviewed->id,
                                            'reviewable_type' => 'App\Models\User',
                                        ]);

        $this->actingAs($userToMakeTheReview)->post("/users/{$userToBeReviewed->id}/reviews", $input)->assertStatus(403); 
    }

}
