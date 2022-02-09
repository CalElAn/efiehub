<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnalyticsTest extends TestCase
{
    use RefreshDatabase;
    

    /** @test */
    public function analytics_can_be_created()
    {
        $this->withoutExceptionHandling();

        $input = [
            'event' => 'clicked share property button',
            'details' => [
                'network' => 'twitter',
                'property_id' => 1,
            ]
        ];

        $response = $this->post('/analytics', $input);

        $response->assertStatus(200);

        $input['details'] = json_encode($input['details']);

        $this->assertDatabaseHas('analytics', $input);                         

    }
}
