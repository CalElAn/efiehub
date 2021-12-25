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

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
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

        Storage::fake('public');

        /**Asynchronously upload 4 pictures for processing */
        $response1 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage1.jpg')]);
        $response2 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage2.jpg')]);
        $response3 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage3.jpg')]);
        $response4 = $this->post('/filepond/process', ['filepond' => UploadedFile::fake()->image('testImage4.jpg')]);

        $input =  [
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
                "Number of washrooms" => "7",
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
        $this->actingAs($user)->post('/add-property', $input);

        $this->assertDatabaseHas('property', [
                                            'user_id' =>$user->id,
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

        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Walled']);                               
        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Living room']);
        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Porch / Balcony']);
        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Dining room']);
        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Furnished']);
        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Number of bedrooms', 'number' => 9]);
        $this->assertDatabaseHas('Property_PropertyFeature_join', ['property_id' => $property->property_id, 'feature' =>'Number of washrooms', 'number' => 7]);

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
