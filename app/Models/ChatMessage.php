<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'chat_message_id';

    public function userSentTo()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

    public function userReceivedFrom()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
}