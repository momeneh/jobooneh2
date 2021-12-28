<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class OrderTrackingNumber extends Notification
{
    use Queueable;
    private $order;
    private $lang;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order,$lang)
    {
        $this->order = $order;
        $this->lang = $lang;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        App::setLocale($this->lang);
        return (new MailMessage) ->subject(__('Tracking number for order'))->view(
            'emails.order_tracking_notify', ['order' => $this->order,'receiver'=>$notifiable]
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
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' =>$this->order->id,
        ];
    }

}
