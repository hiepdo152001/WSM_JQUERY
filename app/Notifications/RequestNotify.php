<?php

namespace App\Notifications;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestNotify extends Notification implements ShouldQueue
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
        $data = $this->toArray($this->user);
        $contact = $this->toStatus($this->contact);
        return (new MailMessage)
            // ->from($data['email'])
            ->greeting('Request form by ' . $data['name'])
            ->line('Title')
            ->line($contact['Title'])
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
        return [
            'email' => $notifiable->email,
            'name' => $notifiable->name,
        ];
    }
    public function toStatus($notifiable)
    {
        return [
            'Title' => $notifiable->content,
        ];
    }
}
