<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($enrollment, $code)
    {
        $this->enrollment = $enrollment;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('support@veedros.com')
            ->markdown('emails.pending-payment')
            ->subject("Your payment code")
            ->with([
                'enrollment' =>$this->enrollment,
                'amanCode' => $this->code,
                'isMail' => true
            ]);
    }
}
