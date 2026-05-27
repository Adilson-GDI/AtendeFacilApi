<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushSchedule extends Model
{
    protected $table = 'push_schedule';

    protected $fillable = [
        'empresa_id',
        'user_id',
        'title',
        'body',
        'image',
        'page',
        'destino',
        'token_destino',
        'topic',
        'action_type',
        'action_value',
        'action_data',
        'send_at',
        'sent',
        'sent_at',
        'error_message',
    ];

    protected $casts = [
        'action_data' => 'array',
        'send_at' => 'datetime',
        'sent_at' => 'datetime',
        'sent' => 'boolean',
    ];
}