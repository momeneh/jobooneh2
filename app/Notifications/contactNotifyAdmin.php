<?php

namespace App\Notifications;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class contactNotifyAdmin extends Notification implements ShouldQueue
{
    use Queueable;
    private $lang;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lang,\App\Models\Contact $message)
    {
        $this->lang = $lang;
        $this->message = $message;
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
        return (new MailMessage) ->subject(__('Contact us notify'))->view(
            'emails.contact', ['receiver'=>$notifiable,'m'=>$this->message]
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
