<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageAttachments extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_at',
        'updated_at',
        'messages_id',
        'file'
    ];
}
