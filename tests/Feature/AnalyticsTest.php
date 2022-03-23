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

    /** @test */
    public function analytics_are_created_when_homepage_is_viewed_from_referrer_link()
    {
        $this->withoutExceptionHandling();
        
        $this->get('/?referrer=instagram');
        // $this->get('/?referrer=instagram');

        $this->assertDatabaseHas('analytics', [
            'event' => 'visit from instagram',
            'details' => 1,
        ]);

        $this->get('/?referrer=instagram');

        $this->assertDatabaseHas('analytics', [
            'event' => 'visit from instagram',
            'details' => 2,
        ]);

        $this->get('/?referrer=instagram');

        $this->assertDatabaseHas('analytics', [
            'event' => 'visit from instagram',
            'details' => 3,
        ]);

        $this->get('/?referrer=twitter');

        $this->assertDatabaseHas('analytics', [
            'event' => 'visit from twitter',
            'details' => 1,
        ]);
    }
}
