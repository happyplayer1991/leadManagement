<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
use Lang;
use App\Models\Lead;


class LeadActionNotification extends Notification
{
    use Queueable;

    private $lead;
    private $action;

    /**
     * Create a new notification instance.
     * LeadActionNotification constructor.
     * @param $lead
     * @param $action
     */
    public function __construct($lead, $action)
    {
        $this->lead = $lead;
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
            case 'created':
                $text = __(':name was created by :creator', [
                'name' => $this->lead->name,
                'creator' => Auth()->check() ? Auth()->user()->name : 'unauthorized user'
                ]);
                break;
            case 'updated':
                $text = __(':name was updated by :creator', [
                'name' => $this->lead->name,
                'creator' => Auth()->user()->name
                ]);
                break;
            case 'dropped':
                $text = __(':name was dropped by :creator', [
                'name' => $this->lead->name,
                'creator' => Auth()->user()->name
                ]);
                break;
            default:
                break;
        }
        return [
            'assigned_user' => $notifiable->id, //Assigned user ID
            'created_user' => $this->lead->user_id,
            'company_id' => $this->lead->company_id,
            'message' => $text,
            'type' => Lead::class,
            'type_id' =>  $this->lead->id,
            'url' => url('leads/' . $this->lead->id),
            'action' => $this->action
        ];
    }
}
