<?php

namespace App\Notifications;

use App\Models\NewsletterReceivers;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Newsletter extends Notification implements ShouldQueue
{
    use Queueable;
    private $lang;
    private $record;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lang,$record)
    {
        $this->lang = $lang;
        $this->record = $record;
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
//        ESql();
        App::setLocale($this->lang);
        return (new MailMessage) ->subject($this->record->title)->view(
            'emails.newsletter', ['body'=>$this->record->body]
        );
        //two job after mail sent handled in listener:
        //1:count_receivers in newsletter
        //2:detail newsletter_receivers

    }

    public function SetCountReceivers(){
        $this->record->count_receivers = $this->record->count_receivers+1;
        $this->record->save();
    }

    public function AddDetailReceivers($subscriber_id){

        NewsletterReceivers::AddReceivers($subscriber_id,$this->record->id,Carbon::now()->toDateTimeString());
//        Log::debug(DSql());
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
}
