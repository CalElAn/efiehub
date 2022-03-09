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
use App\Models\Review;
use App\Models\Report;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

use App\Http\Helpers\HelperMethods;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_property_index_can_be_viewed()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('paginatedProperties', Property::latest()->paginate(6));
    }

    /** @test */
    public function a_property_can_be_shown()
    {
        $property = Property::factory()->create();

        $response = $this->get("/properties/{$property->slug}");

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'property' => $property,
            'paginatedProperties' => Property::where([
                ['region', $property->region],
                ['type', $property->type],
                ['slug', '!=', $property->slug],
            ])
            ->paginate(10)
        ]);
    }

    /** @test */
    public function the_form_to_create_a_property_can_be_viewed()
    {
        $property = new Property;

        $response = $this->get('/properties/create');

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'propertyTypesAndFeatures' => $property->getAllTypesAndFeatures(), 
            'mode' => 'create',
            'property' => $property
        ]);
    }

    public function createAPropertyAndReturnParams()
    {
        Storage::fake('public');

        /**Asynchronously upload 4 pictures for processing */
        $response1 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage1.jpg')]);
        $response2 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage2.jpg')]);
        $response3 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage3.jpg')]);
        $response4 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage4.jpg')]);

        $input =  [
            "region" => "Greater Accra",
            "city" => "Voluptas ipsa repud",
            "town" => "Et elit dicta eos",
            "address" => "Sapiente quis ut et",
            "gpsLocation" => "5.6295424,-0.19005439999999998",
            "contactPhoneNumber" => "+1 (891) 437-5757",
            "contactEmail" => "cinugewiz@mailinator.com",
            "type" => "Apartment",
            "checkedFeatures" => [
                0 => "Walled",
                1 => "Living room",
                2 => "Porch / Balcony",
                3 => "Dining room",
            ],
            "pickedFeatures" => "Furnished",
            "inputFeatures" => [
                "Number of bedrooms" => "9",
                "Number of bathrooms" => "7",
            ],
            "otherFeatures" => [
                0 => "Other feature 1",
                1 => "Other feature 2",
                2 => "other feature 3",
            ],
            "price" => "400",
            "negotiable" => true,
            "media" => [ /**location ID of stored media is returned to the frontend, and added as inout when form is submitted */
                0 => $response1->content(),
                1 => $response2->content(),
                2 => $response3->content(),
                3 => $response4->content(),
            ]
        ];

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        $this->actingAs($user)->post('/properties', $input)->assertStatus(201); //means created

        $property = Property::latest()->first();

        return [
            'responses' => [
                $response1,
                $response2,
                $response3,
                $response4,
            ],
            'input' => $input,
            'user' => $user,
            'property' => $property,
        ];
    }

    public function propertyMediaAssertions($responses, $user, $property, $assertIfMediaIsDeleted = false)
    {
        /** @var \Illuminate\Filesystem\Filesystem */
        $storagePublicDisk = Storage::disk('public'); //otherwise PHP intelephense cant detect method and returns undefined method since it looks for it from interface

        if($assertIfMediaIsDeleted == true)
        {
            foreach($responses as $value)
            {
                $responsePath = $user->id.'/'.$property->property_id.'/'.$value->content();
    
                $storagePublicDisk->assertMissing($responsePath);
    
                $this->assertDatabaseMissing('property_media', [
                    'property_id' => $property->property_id, 
                    'path' => $responsePath,
                ]);                         
            }                         
    
            return;
        }

        foreach($responses as $value)
        {
            $storagePublicDisk->assertMissing('filepond/tmp/'.$value->content());

            $responsePath = $user->id.'/'.$property->property_id.'/'.$value->content();

            $storagePublicDisk->assertExists($responsePath);

            $this->assertDatabaseHas('property_media', [
                'property_id' => $property->property_id, 
                'path' => $responsePath,
                'mime_type' => $storagePublicDisk->mimeType($responsePath),
                'extension' => pathinfo(storage_path('app/public').$responsePath, PATHINFO_EXTENSION),
                // 'size_in_bytes' => $storagePublicDisk->size($response1path),
                // 'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($response1path)),
            ]);                         
        }                         
    }

    /** @test */
    public function a_property_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $params = $this->createAPropertyAndReturnParams();

        $input = $params['input'];
        $user = $params['user'];
        $property = $params['property'];

        $this->assertDatabaseHas('properties', [
                                            'user_id' =>$user->id,
                                            'slug' => 'apartment-in-et-elit-dicta-eos',
                                            "region" => $input['region'],
                                            'city' => $input['city'],
                                            'town' => $input['town'],
                                            'address' => $input['address'],
                                            'gps_location' => $input['gpsLocation'],
                                            'type' => $input['type'],
                                            'other_features' => json_encode($input['otherFeatures']),
                                            'price' => $input['price'],
                                            'is_rent_negotiable' => $input['negotiable'],
                                            'is_advance_negotiable' => false,
                                            'contact_phone_number' => $input['contactPhoneNumber'],
                                            'contact_email' => $input['contactEmail'],
                                            'is_property_available' => true,
                                        ]);
                                    

        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $input['checkedFeatures'][0]]);                               
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $input['checkedFeatures'][1]]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $input['checkedFeatures'][2]]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $input['checkedFeatures'][3]]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $input['pickedFeatures']]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => 'Number of bedrooms', 'number' => 9]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => 'Number of bathrooms', 'number' => 7]);

        $this->propertyMediaAssertions($params['responses'], $user, $property);
    }

    /** @test */
    public function a_property_can_be_updated()
    {
        $params = $this->createAPropertyAndReturnParams();

        $input = $params['input'];
        $user = $params['user'];
        $property = $params['property'];

        $newResponse1 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage5.jpg')]);
        $newResponse2 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage6.jpg')]);

        $updatedInput =  [
            "region" => "Ashanti Region",
            "city" => "Updated City",
            "town" => "Updated town",
            "address" => "Updated address",
            "gpsLocation" => "Updated location",
            "contactPhoneNumber" => "Updated phone number",
            "contactEmail" => "updatedemail@gmail.com",
            "type" => "House",
            "checkedFeatures" => [
                0 => "Walled",
                1 => "Living room",
                2 => "Kitchen",
                // 2 => "Porch / Balcony", assert missing 
                // 3 => "Dining room", assert missing
            ],
            "pickedFeatures" => "Unfurnished",
            "inputFeatures" => [
                "Number of bedrooms" => "5",
                "Number of bathrooms" => null, //should be 1 in the database
            ],
            "otherFeatures" => [
                0 => "Updated feature 1",
                1 => "Updated feature 2",
            ],
            "price" => "900",
            "negotiable" => false,
            "media" => [ /**location ID of stored media is returned to the frontend, and added as inout when form is submitted */
                0 => $newResponse1->content(),
                1 => $newResponse2->content(),
                // 2 => $response1->content(), assert missing
                // 3 => $response2->content(), assert missing
            ]
        ];

        $this->actingAs($user)->patch('/properties/'.$property->slug, $updatedInput)->assertStatus(200);

        $this->assertDatabaseHas('properties', [
            'user_id' =>$user->id,
            'slug' => 'house-in-updated-town',
            "region" => $updatedInput['region'],
            'city' => $updatedInput['city'],
            'town' => $updatedInput['town'],
            'address' => $updatedInput['address'],
            'gps_location' => $updatedInput['gpsLocation'],
            'type' => $updatedInput['type'],
            'other_features' => json_encode($updatedInput['otherFeatures']),
            'price' => $updatedInput['price'],
            'is_rent_negotiable' => $updatedInput['negotiable'],
            'is_advance_negotiable' => false,
            'contact_phone_number' => $updatedInput['contactPhoneNumber'],
            'contact_email' => $updatedInput['contactEmail'],
            'is_property_available' => true,
        ]);
    
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $updatedInput['checkedFeatures'][0]]);                               
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $updatedInput['checkedFeatures'][1]]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $updatedInput['checkedFeatures'][2]]);
        $this->assertDatabaseMissing('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => 'Porch / Balcony']);
        $this->assertDatabaseMissing('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => 'Dining room']);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => $updatedInput['pickedFeatures']]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => 'Number of bedrooms', 'number' => 5]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' => 'Number of bathrooms', 'number' => 1]);

        $this->propertyMediaAssertions([$newResponse1, $newResponse2], $user, $property);

        $mediaToDelete = [$params['responses'][0], $params['responses'][1]];

        $this->actingAs($user)->delete('/filepond/remove/PropertyMedia/1');
        $this->actingAs($user)->delete('/filepond/remove/PropertyMedia/2');

        $this->propertyMediaAssertions($mediaToDelete, $user, $property, true);
    }

    /** @test */
    public function a_property_can_be_deleted()
    {
        $params = $this->createAPropertyAndReturnParams();

        $user = $params['user'];
        $property = $params['property'];

        $review = Review::factory()->create([
            'reviewable_id' => $property->property_id, 
            'reviewable_type' => 'App\Models\Property'
        ]);
        $report = Report::factory()->create([
            'reportable_id' => $property->property_id, 
            'reportable_type' => 'App\Models\Property'
        ]);
 
        $this->actingAs($user)->delete('/properties/'.$property->slug)->assertStatus(200);

        $this->assertDatabaseMissing('Properties', $property->getAttributes());

        /** @var \Illuminate\Filesystem\Filesystem */
        $storagePublicDisk = Storage::disk('public'); 

        foreach($property->media as $propertyMedia)
        {
            $this->assertDatabaseMissing('property_media', $propertyMedia->getAttributes());  
            $storagePublicDisk->assertMissing($propertyMedia->path);                       
        }

        foreach($property->features as $propertyFeature)
        {
            $this->assertDatabaseMissing('Properties_PropertyFeatures_join', $propertyFeature->getAttributes());  
        }

        $this->assertDatabaseMissing('Reviews', $review->getAttributes());
        $this->assertDatabaseMissing('Reports', $report->getAttributes());
    }

    /** @test */
    public function regions_can_be_searched()
    {
        $this->withoutExceptionHandling();

        $this->get('/properties/search')->assertStatus(200);

        Property::factory()->create([
            'region' => 'Greater Accra',
        ]);
        Property::factory()->create([
            'region' => 'Greater Accra',
        ]);
        Property::factory()->create([
            'region' => 'Not Greater Accra',
        ]);
        Property::factory()->create([
            'region' => 'Volta',
        ]);
        Property::factory()->create([
            'region' => 'Ashanti',
        ]);

        $searchInput =  [
            "regions" => [
                0 => "Greater Accra",
                1 => 'Ashanti'
            ]
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties']->pluck('region')->all();

        $this->assertEquals(3, count($response));

        $this->assertContains('Greater Accra', $response);
        $this->assertContains('Ashanti', $response);
        $this->assertNotContains('Not Greater Accra', $response);
        $this->assertNotContains('Volta', $response);
    }

    /** @test */
    public function types_can_be_searched()
    {
        $this->withoutExceptionHandling();

        Property::factory()->create([
            'type' => 'Apartment',
        ]);
        Property::factory()->create([
            'type' => 'Apartment',
        ]);
        Property::factory()->create([
            'type' => 'House',
        ]);
        Property::factory()->create([
            'type' => 'House',
        ]);
        Property::factory()->create([
            'type' => 'Chamber and hall',
        ]);
        Property::factory()->create([
            'type' => 'Single room',
        ]);

        $searchInput =  [
            "types" => [
                0 => "Apartment",
                1 => "House"
            ],
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties']->pluck('type')->all();

        $this->assertEquals(4, count($response));

        $this->assertContains('Apartment', $response);
        $this->assertContains('House', $response);
        $this->assertNotContains('Chamber and hall', $response);
        $this->assertNotContains('Single room', $response);
    }

    /** @test */
    public function price_range_can_be_searched()
    {
        $this->withoutExceptionHandling();

        Property::factory()->create([
            'price' => 100,
        ]);
        Property::factory()->create([
            'price' => 150,
        ]);
        Property::factory()->create([
            'price' => 200,
        ]);
        Property::factory()->create([
            'price' => 500,
        ]);

        $searchInput =  [
            "types" => [
                0 => "Apartment",
            ],
            "priceRange" => [
                0 => "100",
                1 => "250",
            ],
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties'];

        // dd($response['properties']);

        $this->assertEquals(3, count($response));

        foreach ($response as $value)
        {
            $this->assertGreaterThanOrEqual(100, $value->price );
            $this->assertLessThanOrEqual(250, $value->price );
        }
    }

    /** @test */
    public function properties_can_be_searched()
    {
        $this->withoutExceptionHandling();

        Property::factory()->create([
            'region' => 'Greater Accra',
            'type' => 'Apartment',
            'price' => 100,
        ]);
        Property::factory()->create([
            'region' => 'Ashanti',
            'type' => 'House',
            'price' => 200,
        ]);
        Property::factory()->create([
            'region' => 'Volta',  //region not in search input filter
            'type' => 'House', 
            'price' => 200,
        ]);
        Property::factory()->create([
            'region' => 'Ashanti',
            'type' => 'Single room', //type not in search input filter
            'price' => 200,
        ]);
        Property::factory()->create([
            'region' => 'Greater Accra',
            'type' => 'Apartment',
            'price' => 300, //rent above search input filter range
        ]);
        Property::factory()->create([
            'region' => 'Greater Accra',
            'type' => 'Apartment',
            'price' => 99, //rent below search input filter range
        ]);


        $searchInput =  [
            "regions" => [
                0 => "Greater Accra",
                1 => 'Ashanti'
            ],
            "types" => [
                0 => "Apartment",
                1 => "House"
            ],
            "priceRange" => [
                0 => "100",
                1 => "250",
            ],
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties'];

        $this->assertEquals(2, count($response));

        $typeArray = $response->pluck('type')->all();
        $regionArray = $response->pluck('region')->all();

        $this->assertContains('Apartment', $typeArray);
        $this->assertContains('House', $typeArray);
        $this->assertNotContains('Single room', $typeArray);
        
        $this->assertContains('Greater Accra', $regionArray);
        $this->assertContains('Ashanti', $regionArray);
        $this->assertNotContains('Volta', $regionArray);
        
        foreach ($response as $value)
        {
            $this->assertGreaterThanOrEqual(100, $value->price );
            $this->assertLessThanOrEqual(250, $value->price );
        }
    }

    /** @test */
    public function properties_can_be_sorted()
    {
        $this->withoutExceptionHandling();

        Property::factory()->create([
            'created_at' => '2021-12-18 19:55:21',
            'price' => 400,
        ]);
        Property::factory()->create([
            'created_at' => '2021-12-18 19:50:21',
            'price' => 100,
        ]);
        Property::factory()->create([
            'created_at' => '2021-12-17 19:45:21',
            'price' => 300,
        ]);

        $searchInput =  [
            //to check when no order by in request query (should be auto ordered by latest)
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties']->pluck('created_at')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals('2021-12-18 19:55:21', $response[0]->toDateTimeString());
        $this->assertEquals('2021-12-18 19:50:21', $response[1]->toDateTimeString());
        $this->assertEquals('2021-12-17 19:45:21', $response[2]->toDateTimeString());

        $searchInput =  [
            "orderBy" => 'newest',
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties']->pluck('created_at')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals('2021-12-18 19:55:21', $response[0]->toDateTimeString());
        $this->assertEquals('2021-12-18 19:50:21', $response[1]->toDateTimeString());
        $this->assertEquals('2021-12-17 19:45:21', $response[2]->toDateTimeString());

        $searchInput =  [
            "orderBy" => 'priceLowToHigh',
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties']->pluck('price')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals(100, $response[0]);
        $this->assertEquals(300, $response[1]);
        $this->assertEquals(400, $response[2]);

        $searchInput =  [
            "orderBy" => 'priceHighToLow',
        ];

        $response = $this->get('/properties/search?'.http_build_query($searchInput))['paginatedProperties']->pluck('price')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals(400, $response[0]);
        $this->assertEquals(300, $response[1]);
        $this->assertEquals(100, $response[2]);
    }

    /** @test */
    public function a_property_can_be_reported()
    {
        $this->withoutExceptionHandling();

        $input = ['body' => 'random report body string'];
        $property = Property::factory()->create();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        $this->actingAs($user)->post("/properties/{$property->slug}/reports", $input)->assertStatus(201); 

        $this->assertDatabaseHas('reports', [
                                            'user_id' =>$user->id,
                                            'body' => $input['body'],
                                            'reportable_id' => $property->property_id,
                                            'reportable_type' => 'App\Models\Property',
                                        ]);
    }

    /** @test */
    public function a_property_can_be_reviewed()
    {
        $input = [
            'rating' => 3.5,
            'body' => 'random review string'
        ];

        $property = Property::factory()->create();

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        $this->actingAs($user)->post("/properties/{$property->slug}/reviews", $input)->assertStatus(201);

        $this->assertDatabaseHas('reviews', [
                                            'user_id' =>$user->id,
                                            'rating' => $input['rating'],
                                            'review' => $input['body'],
                                            'reviewable_id' => $property->property_id,
                                            'reviewable_type' => 'App\Models\Property',
                                        ]);

        $this->actingAs($user)->post("/properties/{$property->slug}/reviews", $input)->assertStatus(403); 
    }

    /** @test */
    public function a_property_can_be_archived_and_unarchived()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userWhoDidNotCreateProperty = User::factory()->create();

        $property = Property::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($userWhoDidNotCreateProperty)->patch("/properties/{$property->slug}/archive")->assertStatus(403); 

        $this->actingAs($userWhoDidNotCreateProperty)->patch("/properties/{$property->slug}/archive")->assertStatus(403); 

        $this->actingAs($user)->patch("/properties/{$property->slug}/archive")->assertStatus(200); 
        $this->assertNotNull($property->fresh()->archived_at);

        $this->actingAs($user)->patch("/properties/{$property->slug}/archive")->assertStatus(200); 
        $this->assertNull($property->fresh()->archived_at);
    }

    /** @test */
    public function the_property_edit_page_can_be_showed()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        $property = Property::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/properties/{$property->slug}/edit");
        $response->assertStatus(200); 
        $response->assertViewHasAll([
            'propertyTypesAndFeatures' => $property->getAllTypesAndFeatures(), 
            'mode' => 'edit',
            'property' => $property
        ]);

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userWhoDidNotCreateProperty = User::factory()->create();
        $this->actingAs($userWhoDidNotCreateProperty)->get("/properties/{$property->slug}/edit")->assertStatus(403);
    }

    public function createAUserWithEverything()
    {
        //* tinker shortcut (use sail artisan tinker instead of sail php tinker)
        //* (new Tests\Feature\PropertyTest)->createAUserWithEverything()

        //create a user with properties (type = Apartment) with features

        $articleFactory = Article::factory()->count(2);

        $favouritedPropertyFactory = FavouritedProperty::factory()->count(2);

        $propertyReviewFactory = PropertyReview::factory()->count(2);

        $propertyMediaFactory = PropertyMedia::factory()->count(5);

        $propertyFeatures = DB::table('PropertyType_PropertyFeature_join')
                                ->where('type', 'Apartment')
                                ->select('feature')
                                // ->limit(6)
                                ->get(); 

        $propertyFactory = Property::factory()->count(1)
                                        ->hasAttached($propertyFeatures, [], 'features')
                                        ->has($propertyMediaFactory, 'media')
                                        ->has($propertyReviewFactory, 'reviews');
        
        $userFactory = User::factory()->count(1)->has($favouritedPropertyFactory, 'favouritedProperties')
                                                ->has($articleFactory, 'articles')
                                                ->has($propertyFactory, 'properties')
                                                ->create();
        
        // return($userFactory);
        //using make instead of create will not persist it
    }

}
