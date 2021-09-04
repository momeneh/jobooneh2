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

class ProductChanged extends Notification implements ShouldQueue
{
    use Queueable;
    public $product;
    public $user;
    private $changes;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product,$user,$changes)
    {
        $this->delay = config('', 10);
        $this->product = $product;
        $this->user = $user;
        $this->changes = $changes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
        return (new MailMessage) ->subject(__('messages.product_changed'))->view(
            'emails.user_edited_product', ['product' => $this->product,'receiver'=>$notifiable,'owner'=>$this->user,'changes'=>$this->changes]
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
