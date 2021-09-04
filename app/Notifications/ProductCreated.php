<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProductCreated extends Notification implements ShouldQueue
{
    use Queueable;
    public $product;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product,$user)
    {
        $this->delay = config('', 10);
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($this->user == 'owner') return ['mail'];
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        if($this->user == 'owner') {
            App::setLocale($this->product->lang->abr);
            return (new MailMessage)->subject(__('messages.product_created'))->view(
                'emails.user_product', ['product' => $this->product, 'receiver' => $notifiable]
            );
        }else
            return (new MailMessage) ->subject(__('messages.product_confirm'))->view(
            'emails.user_create_product', ['product' => $this->product,'receiver'=>$notifiable,'owner'=>$this->user]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'pro_id'=>$this->product->id

        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' =>$this->product->id,
            'name_user'=> $this->user->name,
            'id_user' =>$this->user->id,
        ];
    }

}
