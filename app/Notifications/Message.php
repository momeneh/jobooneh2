<?php

namespace App\Notifications;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class Message extends Notification implements ShouldQueue
{
    use Queueable;
    use SmsChannel;
    private $lang;
    private $message;
    private $sms_messsage ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lang,\App\Models\Message $message)
    {
        $this->lang = $lang;
        $this->message = $message;
        $this->sms_messsage = __('messages.sms_message_received').'
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
        return ['mail',$this->SmsChannelChooser()];
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
        $prefix = ($this->message->receiver_type == 'App\Models\Admin')? 'admin.' : '';

        return (new MailMessage) ->subject($this->message->subject)->view(
            'emails.message', ['receiver'=>$notifiable,'sender'=>$this->message->sender,'id'=>$this->message->id,'lang'=>$this->lang,'prefix'=>$prefix]
        );    }

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
}
