<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

use App\Models\ChatMessage;
use App\Models\User;
use App\Events\ChatMessageSent;

class ChatMessageControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function chat_messages_can_be_fetched()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userSendingMessages = User::factory()->create();
        $userReceivingMessages = User::factory()->create();

        ChatMessage::factory()->count(2)->create([
            'from_user_id' => $userSendingMessages->id,
            'to_user_id' => $userReceivingMessages->id,
        ]);
        ChatMessage::factory()->count(2)->create([
            'from_user_id' => $userReceivingMessages->id,
            'to_user_id' => $userSendingMessages->id,
        ]);

        $response = $this->actingAs($userSendingMessages)->get("/chat-messages/{$userReceivingMessages->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'messages' =>            
                ChatMessage::where([
                    ['from_user_id', $userSendingMessages->id],
                    ['to_user_id', $userReceivingMessages->id],
                ])
                ->get()
                ->concat(
                    ChatMessage::where([
                        ['from_user_id', $userReceivingMessages->id],
                        ['to_user_id', $userSendingMessages->id],
                    ])
                    ->get()
                )
                ->sortBy('created_at')
                ->values()
                // ->all() for some strange reason I dont know, using all() returns a different value than what is expected from the response
                ->toArray(), 
        ]);
    }

    /** @test */
    public function chat_messages_can_be_sent_and_broadcasted()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $userSendingMessages = User::factory()->create();
        $userReceivingMessages = User::factory()->create();

        $message = [
            'messaged_user_id' => $userReceivingMessages->id,
            'message' => $this->faker->paragraphs(1, true),
        ];

        Event::fake();

        $response = $this->actingAs($userSendingMessages)->post("/chat-messages", $message);
        $response->assertCreated();

        $createdChatMessage = $response->getContent();
        
        Event::assertDispatched(function (ChatMessageSent $event) use ($createdChatMessage) {
            return $event->chatMessage->toJson() === $createdChatMessage;
        });

        $this->assertDatabaseHas('chat_messages', [
            'from_user_id' => $userSendingMessages->id,
            'to_user_id' => $message['messaged_user_id'],
            'message' => $message['message'], 
        ]);
    }
}
