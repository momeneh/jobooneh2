<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Newsletter extends Model
{
    use HasFactory;

    public function subscribers()
    {
        $d = app(Subscriber::class)->getTable();
        $d2 = app(NewsletterReceivers::class)->getTable();
        return $this->belongsToMany(Subscriber::class,NewsletterReceivers::class,'newsletters_id','subscribers_id')
            ->select([$d.'.id',$d.'.mail','l.abr as lang_id',$d.'.created_at',$d2.'.created_at as sent_at'])
            ->join('langs As l',function ($join){
                $join->on('l.id', '=', 'subscribers.lang_id');
            } );
    }

    public function InsertBy(){
        return $this->hasOne(Admin::class,'id','admins_id');
    }

    public function Receivers()
    {
        return $this->belongsToMany(Subscriber::class,'newsletter_receivers','newsletters_id','subscribers_id');
    }


}
