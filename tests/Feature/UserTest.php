<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\FavouriteProperty;
use App\Models\PropertyMedia;
use App\Models\PropertyReview;
use App\Models\Article;

use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_favourite_a_property()
    {
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $property = Property::factory()->create();

        $this->actingAs($user)->post('/favourite-property', ['propertyId' => $property->property_id]);

        $this->assertDatabaseHas('favourite_property', ['user_id' => $user->id, 'property_id' => $property->property_id]);
    }

    /** @test */
    public function a_user_can_unfavourite_a_property()
    {
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $property = Property::factory()->create();

        $this->actingAs($user)->post('/favourite-property', ['propertyId' => $property->property_id]);

        $this->actingAs($user)->post('/favourite-property', ['propertyId' => $property->property_id]);

        $this->assertDatabaseMissing('favourite_property', ['user_id' => $user->id, 'property_id' => $property->property_id]);
    }
}
