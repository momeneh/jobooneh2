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

class AdminNotifyUser extends Notification implements ShouldQueue
{
    use Queueable;
    public $product;
    public $user;
    private $desc;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product,$user,$desc)
    {
        $this->delay = config('', 10);
        $this->product = $product;
        $this->user = $user;
        $this->desc = $desc;
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
        App::setLocale($this->product->lang->abr);
        return (new MailMessage) ->subject(__('messages.admin_notify'))->view(
            'emails.admin_notify_user', ['product' => $this->product,'receiver'=>$notifiable,'admin'=>$this->user,'desc'=>$this->desc]
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
            'desc' => $this->desc,
            'sender' => $this->user->id
        ];
    }

}
