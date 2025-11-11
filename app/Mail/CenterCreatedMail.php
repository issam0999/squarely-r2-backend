<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CenterCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public $center;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $user
     * @param  mixed  $center
     * @return void
     */
    public function __construct($user, $center)
    {
        $this->user = $user;
        $this->center = $center;
    }

    public function build()
    {
        return $this->from('no-reply@yourdomain.com', $this->user->name ?? 'Squarely')
            ->replyTo($this->user->email, $this->user->name)
            ->subject('New Center Created')
            ->view('emails.center_created');
    }
}
