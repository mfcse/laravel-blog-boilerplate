<?php

namespace App\Notifications;

use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;
    public function __construct(User $user)
    {
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
        return ['mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Dear ' . $this->user->name)
            ->line('Your account has been created, please click the following link to activate your account')
            ->action('Click to verify your account', route('verify', $this->user->email_verification_token))
            ->line('Your account has been created, please click the following link to activate your account');
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
    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    // public function toNexmo($notifiable)
    // {
    //     return (new NexmoMessage)
    //         ->content('Dear, ' . $this->user->name . ', Your account has been successfully created');
    // }

    public function failed(Exception $exception)
    {

        Log::debug('MyNotification failed');
    }
}