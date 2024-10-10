<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notification_mail extends Notification
{
    use Queueable;
    private $notification_id;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification_id)
    {
        $this->notification_id =  $notification_id;
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

        $url = url('/').'/notifications/'.$this->notification_id->id;

        return (new MailMessage)
            ->subject('اضافة اشعار جديدة')
            ->line('اضافة اشعار جديدة')
            ->action('عرض اشعار', $url)
            ->line('شكرا لاستخدامك لادارة الاشعارات');
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
