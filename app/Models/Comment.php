<?php

namespace App\Models;

use App\Helpers\Helper;
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

    public function product(){
        return $this->belongsTo(Product::class,'products_id','id');
    }
}
