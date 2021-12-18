<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Property;

class FilePondTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function a_file_is_processed_after_uploading()
    {
        Storage::fake('public');

        $testImage = UploadedFile::fake()->image('testImage.jpg');

        $response = $this->post('/filepond/process', ['filepond' => $testImage]);

        $locationID = $response->content();
        /**to assert that file exists */
        Storage::disk('public')->assertExists('filepond/tmp/'.$locationID); 
        /**to assert that file location ID was returned */
        $response->assertSee($locationID);
    }

    /** @test */
    public function a_file_is_deleted_after_reverting_it()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $testImage1 = UploadedFile::fake()->image('testImage1.jpg');
        $testImage2 = UploadedFile::fake()->image('testImage2.jpg');

        $response1 = $this->post('/filepond/process', ['filepond' => $testImage1]);
        $response2 = $this->post('/filepond/process', ['filepond' => $testImage2]);

        $locationID1 = $response1->content();
        $locationID2 = $response2->content();
        
        Storage::disk('public')->assertExists('filepond/tmp/'.$locationID1); 
        Storage::disk('public')->assertExists('filepond/tmp/'.$locationID2); 

        $this->call('delete', '/filepond/revert', [], [], [], [], $locationID1);
        $this->call('delete', '/filepond/revert', [], [], [], [], $locationID2);

        Storage::disk('public')->assertMissing('filepond/tmp/'.$locationID1); 
        Storage::disk('public')->assertMissing('filepond/tmp/'.$locationID2); 
    }

}
