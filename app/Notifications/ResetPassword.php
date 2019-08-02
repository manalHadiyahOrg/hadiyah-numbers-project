<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
/*reset password email
*7/7/2019
*/
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{

  /*reset password email
  *7/7/2019
  */
class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
      /*reset password email
      *7/7/2019
      */
      return (new MailMessage)
      ->subject('Promjena lozinke - ' . config('app.name'))
      ->line('Ovaj e-mail Vam je poslat jer ste zahtijevali promjenu lozinke za vaš nalog.')
      ->action('Promjena lozinke', url('password/reset', $this->token))
      ->line('Ukoliko nijeste zahtijevali promjenu lozinke, ignorišite ovaj e-mail.');
      /*reset password email
      *7/7/2019
      */
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
