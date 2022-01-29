<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id', 'phone', 'message', 'sent_at', 'delivery_status',
    ];
}
