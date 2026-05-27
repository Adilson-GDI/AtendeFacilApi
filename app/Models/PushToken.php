<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushToken extends Model
{
    protected $table = 'push_tokens';

    protected $fillable = [
        'empresa_id',
        'user_id',
        'push_token',
        'device_name',
        'platform',
        'permission',
        'tipo_servico',
        'app_version',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];
}