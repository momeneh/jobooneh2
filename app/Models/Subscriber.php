<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Subscriber extends Model
{
    use HasFactory;
    use Notifiable;

    public function Newsletter(){
        return $this->belongsToMany(Newsletter::class,'newsletter_receivers');
    }

    public function routeNotificationForMail()
    {
//        return  'momeneh.jafari@gmail.com';
        return $this->mail;
    }
}
