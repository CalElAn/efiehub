<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\ChatMessageSent;

class ChatMessageController extends Controller
{
    public function getChatMessages(Request $request)
    {
        abort_if(Auth::user()->id === $request->messaged_user_id, 403);  //just in case someone was able to bypass the check in the store method

        $messagesFromAuthUser = ChatMessage::where([
            ['from_user_id', Auth::user()->id],
            ['to_user_id', $request->messaged_user_id],
        ])->get();

        $messagesToAuthUser = ChatMessage::where([
            ['to_user_id', Auth::user()->id],
            ['from_user_id', $request->messaged_user_id],
        ])->get();

        return response([
            'messages' => 
                $messagesFromAuthUser->concat($messagesToAuthUser)->sortBy('created_at')->values()->all(),
        ]);
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->id === $request->messaged_user_id, 403); //to ensure you cant send messages to yourself

        $createdChatMessage = ChatMessage::create([
            'from_user_id' => Auth::user()->id,
            'to_user_id' => $request->messaged_user_id,
            'message' => $request->message,
        ]);

        broadcast(new ChatMessageSent($createdChatMessage))->toOthers();

        return $createdChatMessage;
    }
}
