<?php
namespace App\Notifications;

use Illuminate\Support\Facades\App;
use NotificationChannels\RayganSms\RayganSmsChannel;
use NotificationChannels\RayganSms\TextMessage;

trait SmsChannel {


    public function SmsChannelChooser(){
        if(App::getLocale() != 'fa') return '';
        return RayganSmsChannel::class;
    }

    public function toRayganSms($notifiable)
    {
        return (new TextMessage)
            ->content($this->sms_messsage);

    }


}
