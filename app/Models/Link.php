<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    public function link_locations()
    {
        return $this->belongsTo(Link_locations::class,'location_id');
    }
}
