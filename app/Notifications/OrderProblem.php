<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class OrderProblem extends Notification implements ShouldQueue
{
    use Queueable;
    use SmsChannel;
    private $order;
    private $lang;
    private $message;
    private $sms_messsage ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order,$lang,$message)
    {
        $this->order = $order;
        $this->lang = $lang;
        $this->message = $message;
        $this->sms_messsage = __('messages.sms_order_problem',['order'=>$this->order->id]).'
            '.__('title.main_title');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database',$this->SmsChannelChooser()];
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
        return (new MailMessage) ->subject(__('Your order has problem(s)'))->view(
            'emails.order_problem_notify', ['order' => $this->order,'receiver'=>$notifiable,'body_desc'=>$this->message]
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
