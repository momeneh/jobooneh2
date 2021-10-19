<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_at',
        'updated_at',
        'products_id',
        'name',
        'email',
        'comment'
    ];
}
