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
        $stt = [
            1 => 'Yêu cầu mới',
            2 => 'Đã Xác nhận',
            3 => 'Đã chấp nhận',
            4 => 'Từ chối',
            5 => 'Hủy',
        ];
        $notifiable->message = $stt[$notifiable->status];


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
