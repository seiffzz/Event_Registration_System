<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Payment_mail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->mail_data = $mail_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->withSwiftMessage(function ($message){
            $message->setPriority(\Swift_Message::PRIORITY_HIGH);
        })->from('seifalaa173@gmail.com')
            ->subject('Payment Mail | ASPIRE\'20')
            ->markdown('emails.payment_mail')->with($this->mail_data);
    }
}
