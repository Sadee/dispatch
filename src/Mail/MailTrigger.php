<?php

namespace Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailTrigger extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $return = $this->subject($this->details['subject'])
            ->view('emails.' . $this->details['view']);

        if($this->details['attachment']) {
            $return->attach($this->details['attachment']);
        }
        return $return;
    }
}
