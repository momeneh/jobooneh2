<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
//    private function UserSender(){
//        return $this->hasOne(User::class,'id','user_id_sender');
//    }
//
//    private function AdminSender(){
//        return $this->hasOne(Admin::class,'id','user_id_sender');
//    }
//
//    public function Sender(){
//        if($this->user_guard_sender  == 'web') return $this->UserSender();
//        else return $this->AdminSender();
//    }

    public function sender(){
        return $this->morphTo();
    }

    public function receiver(){
        return $this->morphTo();
    }

    public function attachments()
    {
        return $this->hasMany(MessageAttachments::class,'messages_id','id');
    }
}
