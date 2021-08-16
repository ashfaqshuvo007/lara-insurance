<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice_data;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->invoice_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail=$this->from('anand.singh989@gmail.com')
        ->subject('Invoice page generated')
        ->markdown('fontend.dashboard.send-invoice')->with(['invoice_data', $this->invoice_data]);

        $mail = $mail->attach($this->invoice_data['attachments']["path"], [
            'as' => $this->invoice_data['attachments']["as"],
            'mime' => $this->invoice_data['attachments']["mime"],
        ]);
    }
}
