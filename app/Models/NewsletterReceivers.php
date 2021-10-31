<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Parent_;
use phpDocumentor\Reflection\Types\This;

class NewsletterReceivers extends Model
{
    use HasFactory;

    public static  function AddReceivers($subscriber_id,$id,$timeString){

        return self::insert(['subscribers_id'=>$subscriber_id,'newsletters_id'=>$id,'created_at'=>$timeString]);
    }
}
