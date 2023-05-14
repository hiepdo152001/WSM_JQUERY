<?php

namespace App\Notifications;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusReqNotify extends Notification implements ShouldQueue
{
    use Queueable;
    private $contact, $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, User $user)
    {
        $this->contact = $contact;
        $this->user = $user;
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
        $data = $this->toArray($this->contact);
        $user = $this->toStatus($this->user);
        return (new MailMessage)
            // ->from($this->user->email)
            ->subject('Response request')
            ->greeting('Request form by ' . $user['name'])
            ->line('Content:' . $data['content'])
            ->line('Status:' . $data['message'])
            ->action('WSM', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($notifiable->status === 1) {
            $notifiable->message = 'New Request';
        } elseif ($notifiable->status === 2) {
            $notifiable->message = 'Da Xac nhan';
        } elseif ($notifiable->status === 3) {
            $notifiable->message = 'Da chap nhan';
        } elseif ($notifiable->status === 4) {
            $notifiable->message = 'Tu choi';
        } else
            $notifiable->message = 'Huy';

        return [
            'message' => $notifiable->message,
            'content' => $notifiable->content
        ];
    }
    public function toStatus($notifiable)
    {
        return [
            'email' => $notifiable->email,
            'name' => $notifiable->name,
        ];
    }
}
