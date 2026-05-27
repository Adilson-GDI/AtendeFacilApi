<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushLog extends Model
{
    protected $table = 'push_logs';

    protected $fillable = [
        'empresa_id',
        'user_id',
        'title',
        'body',
        'image_url',
        'target_type',
        'target_value',
        'action_type',
        'action_value',
        'action_data',
        'total_targets',
        'total_success',
        'total_error',
        'response_data',
        'sent_at',
    ];

    protected $casts = [
        'action_data' => 'array',
        'response_data' => 'array',
        'sent_at' => 'datetime',
    ];
}