<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
use Lang;
use App\Models\Activities;


class ActivitiesActionNotification extends Notification
{
    use Queueable;

    private $activity;
    private $action;

    /**
     * Create a new notification instance.
     * LeadActionNotification constructor.
     * @param $lead
     * @param $action
     */
    public function __construct($activity, $action)
    {
        $this->activity = $activity;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!'); */
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        switch ($this->action) {
            case 'scheduled':
                $text = __('Activity was created by :creator', [
                'creator' => Auth()->user()->name
                ]);
                break;
            case 'completed':
                $text = __('Activity was closed by :creator', [
                'creator' => Auth()->user()->name
                ]);
                break;
            default:
                break;
        }
        return [
            'assigned_user' => $notifiable->id, //Assigned user ID
            'created_user' => Auth()->user()->id,
            'company_id' => Auth::user()->company_id,
            'message' => $text,
            'type' => Activities::class,
            'type_id' =>  $this->activity->id,
            'url' => url('activities'),
            'action' => $this->action
        ];
    
    }
}
