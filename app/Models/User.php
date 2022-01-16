<?php

namespace App\Models;

use App\Notifications\ResetPasswordUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'address',
        'postal_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordUser($token));
    }

    public function messagesSender()
    {
        return $this->morphMany('App\Models\Message', 'sender');
    }

    public function messagesReceiver()
    {
        return $this->morphMany('App\Models\Message', 'receiver');
    }

    public function Baskets(){
        return $this->hasManyThrough(Basket::class,Product::class,'user_id','products_id');
    }

    public static function SetOwner($user_id){
        DB::statement("UPDATE users SET is_owner =1 WHERE id ='{$user_id}' ");
    }

    public function routeNotificationForRayganSms()
    {
        return $this->mobile_no;
    }

}
