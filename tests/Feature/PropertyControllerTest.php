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
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

use App\Http\Helpers\HelperMethods;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */  
    //*move test to js
    // public function homepage_shows_property_card_with_all_details()
    // {
    //     $this->withoutExceptionHandling();

    //     $this->createAUserWithEverything(); //to set up the database with the properties

    //     $property = Property::latest()->first();

    //     $this->get('/')
    //         ->assertSee($property->propertyType->type)
    //         ->assertSee($property->town)
    //         ->assertSee($property->address)
    //         ->assertSeeInOrder($property->features->pluck('name')->toArray())
    //         ->assertSee($property->reviews->average('rating'))
    //         ->assertSee($property->reviews->count().' reviews')
    //         ->assertSee($property->rent.' / month')
    //     ;
    // }

    /** @test */
    public function a_property_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->get('/add-property')->assertStatus(200);

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
            "description" => "Accusamus sint offic",
            "rent" => "400",
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
        $this->actingAs($user)->post('/add-property', $input)->assertStatus(201); //means created

        $this->assertDatabaseHas('properties', [
                                            'user_id' =>$user->id,
                                            'slug' => 'apartment-in-et-elit-dicta-eos',
                                            "region" => "Greater Accra",
                                            'city' => 'Voluptas ipsa repud',
                                            'town' => 'Et elit dicta eos',
                                            'address' => 'Sapiente quis ut et',
                                            'gps_location' => '5.6295424,-0.19005439999999998',
                                            'type' => 'Apartment',
                                            'description' => "Accusamus sint offic",
                                            'rent' => "400",
                                            'is_rent_negotiable' => true,
                                            'is_advance_negotiable' => false,
                                            'contact_phone_number' => "+1 (891) 437-5757",
                                            'contact_email' => "cinugewiz@mailinator.com",
                                            'is_property_available' => true,
                                        ]);
                                    
        $property = Property::latest()->first();

        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Walled']);                               
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Living room']);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Porch / Balcony']);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Dining room']);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Furnished']);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Number of bedrooms', 'number' => 9]);
        $this->assertDatabaseHas('Properties_PropertyFeatures_join', ['property_id' => $property->property_id, 'feature' =>'Number of bathrooms', 'number' => 7]);

        /** @var \Illuminate\Filesystem\Filesystem */
        $storagePublicDisk = Storage::disk('public'); //otherwise PHP intelephense cant detect method and returns undefined method since it looks for it from interface

        $storagePublicDisk->assertMissing('filepond/tmp/'.$response1->content());
        $storagePublicDisk->assertMissing('filepond/tmp/'.$response2->content());
        $storagePublicDisk->assertMissing('filepond/tmp/'.$response3->content());
        $storagePublicDisk->assertMissing('filepond/tmp/'.$response4->content());

        $response1path = $user->id.'/'.$property->property_id.'/'.$response1->content();
        $response2path = $user->id.'/'.$property->property_id.'/'.$response2->content();
        $response3path = $user->id.'/'.$property->property_id.'/'.$response3->content();
        $response4path = $user->id.'/'.$property->property_id.'/'.$response4->content();

        $storagePublicDisk->assertExists($response1path);
        $storagePublicDisk->assertExists($response2path);
        $storagePublicDisk->assertExists($response3path);
        $storagePublicDisk->assertExists($response4path);
        
        $this->assertDatabaseHas('property_media', [
                                                    'property_id' => $property->property_id, 
                                                    'path' => $response1path,
                                                    'mime_type' => $storagePublicDisk->mimeType($response1path),
                                                    'extension' => pathinfo(storage_path('app/public').$response1path, PATHINFO_EXTENSION),
                                                    'size_in_bytes' => $storagePublicDisk->size($response1path),
                                                    'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($response1path)),
                                                ]);                         
        $this->assertDatabaseHas('property_media', [
                                                    'property_id' => $property->property_id, 
                                                    'path' => $response2path,
                                                    'mime_type' => $storagePublicDisk->mimeType($response2path),
                                                    'extension' => pathinfo(storage_path('app/public').$response2path, PATHINFO_EXTENSION),
                                                    'size_in_bytes' => $storagePublicDisk->size($response2path),
                                                    'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($response2path)),
                                                ]);                         
        $this->assertDatabaseHas('property_media', [
                                                    'property_id' => $property->property_id, 
                                                    'path' => $response3path,
                                                    'mime_type' => $storagePublicDisk->mimeType($response3path),
                                                    'extension' => pathinfo(storage_path('app/public').$response3path, PATHINFO_EXTENSION),
                                                    'size_in_bytes' => $storagePublicDisk->size($response3path),
                                                    'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($response3path)),
                                                ]);                         
        $this->assertDatabaseHas('property_media', [
                                                    'property_id' => $property->property_id, 
                                                    'path' => $response4path,
                                                    'mime_type' => $storagePublicDisk->mimeType($response4path),
                                                    'extension' => pathinfo(storage_path('app/public').$response4path, PATHINFO_EXTENSION),
                                                    'size_in_bytes' => $storagePublicDisk->size($response4path),
                                                    'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($response4path)),
                                                ]);                         
    }

    /** @test */
    public function regions_can_be_searched()
    {
        $this->withoutExceptionHandling();

        $this->get('/search-property')->assertStatus(200);

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

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties']->pluck('region')->all();

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

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties']->pluck('type')->all();

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
            'rent' => 100,
        ]);
        Property::factory()->create([
            'rent' => 150,
        ]);
        Property::factory()->create([
            'rent' => 200,
        ]);
        Property::factory()->create([
            'rent' => 500,
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

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties'];

        // dd($response['properties']);

        $this->assertEquals(3, count($response));

        foreach ($response as $value)
        {
            $this->assertGreaterThanOrEqual(100, $value->rent );
            $this->assertLessThanOrEqual(250, $value->rent );
        }
    }

    /** @test */
    public function properties_can_be_searched()
    {
        $this->withoutExceptionHandling();

        Property::factory()->create([
            'region' => 'Greater Accra',
            'type' => 'Apartment',
            'rent' => 100,
        ]);
        Property::factory()->create([
            'region' => 'Ashanti',
            'type' => 'House',
            'rent' => 200,
        ]);
        Property::factory()->create([
            'region' => 'Volta',  //region not in search input filter
            'type' => 'House', 
            'rent' => 200,
        ]);
        Property::factory()->create([
            'region' => 'Ashanti',
            'type' => 'Single room', //type not in search input filter
            'rent' => 200,
        ]);
        Property::factory()->create([
            'region' => 'Greater Accra',
            'type' => 'Apartment',
            'rent' => 300, //rent above search input filter range
        ]);
        Property::factory()->create([
            'region' => 'Greater Accra',
            'type' => 'Apartment',
            'rent' => 99, //rent below search input filter range
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

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties'];

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
            $this->assertGreaterThanOrEqual(100, $value->rent );
            $this->assertLessThanOrEqual(250, $value->rent );
        }
    }

    /** @test */
    public function properties_can_be_sorted()
    {
        $this->withoutExceptionHandling();

        Property::factory()->create([
            'created_at' => '2021-12-18 19:55:21',
            'rent' => 400,
        ]);
        Property::factory()->create([
            'created_at' => '2021-12-18 19:50:21',
            'rent' => 100,
        ]);
        Property::factory()->create([
            'created_at' => '2021-12-17 19:45:21',
            'rent' => 300,
        ]);

        $searchInput =  [
            //to check when no order by in request query (should be auto ordered by latest)
        ];

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties']->pluck('created_at')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals('2021-12-18 19:55:21', $response[0]->toDateTimeString());
        $this->assertEquals('2021-12-18 19:50:21', $response[1]->toDateTimeString());
        $this->assertEquals('2021-12-17 19:45:21', $response[2]->toDateTimeString());

        $searchInput =  [
            "orderBy" => 'newest',
        ];

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties']->pluck('created_at')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals('2021-12-18 19:55:21', $response[0]->toDateTimeString());
        $this->assertEquals('2021-12-18 19:50:21', $response[1]->toDateTimeString());
        $this->assertEquals('2021-12-17 19:45:21', $response[2]->toDateTimeString());

        $searchInput =  [
            "orderBy" => 'priceLowToHigh',
        ];

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties']->pluck('rent')->all();

        $this->assertEquals(3, count($response));

        $this->assertEquals(100, $response[0]);
        $this->assertEquals(300, $response[1]);
        $this->assertEquals(400, $response[2]);

        $searchInput =  [
            "orderBy" => 'priceHighToLow',
        ];

        $response = $this->get('/search-property?'.http_build_query($searchInput))['properties']->pluck('rent')->all();

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
        $this->actingAs($user)->post("/report-property/{$property->slug}", $input)->assertStatus(201); 

        $this->assertDatabaseHas('reports', [
                                            'user_id' =>$user->id,
                                            'body' => $input['body'],
                                            'reportable_id' => $property->property_id,
                                            'reportable_type' => 'App\Models\Property',
                                        ]);
    }

    public function createAUserWithEverything()
    {
        //* tinker shortcut (use sail artisan tinker instead of sail php tinker)
        //* (new Tests\Feature\PropertyTest)->createAUserWithEverything()

        //create a user with properties (type = Apartment) with features

        $articleFactory = Article::factory()->count(2);

        $favouritePropertyFactory = FavouriteProperty::factory()->count(2);

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
        
        $userFactory = User::factory()->count(1)->has($favouritePropertyFactory, 'favouriteProperties')
                                                ->has($articleFactory, 'articles')
                                                ->has($propertyFactory, 'properties')
                                                ->create();
        
        // return($userFactory);
        //using make instead of create will not persist it
    }

}
