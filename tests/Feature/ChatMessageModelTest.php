<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\ChatMessage;

class ChatMessageModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

   /** @test */ 
   public function a_chat_message_knows_the_user_who_sent_it()
   {
        $userWhoSentChat = \App\Models\User::factory()->create();

        $chatMessage = ChatMessage::factory()->create([
                        'from_user_id' => $userWhoSentChat->id,
                    ]);

        $this->assertInstanceOf('App\Models\User', $chatMessage->userReceivedFrom);
        $this->assertEquals($userWhoSentChat->fresh(), $chatMessage->userReceivedFrom);
   }

   /** @test */ 
   public function a_chat_message_knows_the_user_it_was_sent_to()
   {
        $userWhoReceivedChat = \App\Models\User::factory()->create();

        $chatMessage = ChatMessage::factory()->create([
                        'to_user_id' => $userWhoReceivedChat->id,
                    ]);

        $this->assertInstanceOf('App\Models\User', $chatMessage->userSentTo);
        $this->assertEquals($userWhoReceivedChat->fresh(), $chatMessage->userSentTo);
   }
}
