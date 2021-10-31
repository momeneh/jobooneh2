<?php

namespace App\Listeners;

use App\Models\Newsletter;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Log;

class NewsletterReceiversSave
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        //1:count_receilvers in newsletter
        $event->notification->SetCountReceivers();

        //2:detail newsletter_receivers
        $event->notification->AddDetailReceivers($event->notifiable->id);

    }
}
