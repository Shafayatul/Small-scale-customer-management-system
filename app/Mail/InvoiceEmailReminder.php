<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmailReminder extends Mailable
{
    use Queueable, SerializesModels;
    public $customer, $products, $ref, $billing_date, $due_date, $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $products, $ref, $billing_date, $due_date, $pdf)
    {
        $this->customer     = $customer;
        $this->products     = $products;
        $this->ref          = $ref;
        $this->billing_date = $billing_date;
        $this->due_date     = $due_date;
        $this->pdf          = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.InvoiceEmailReminder')
                ->attachData($this->pdf, 'ReminderInvoice.pdf', [
                    'mime' => 'application/pdf',
                ]);
    }
}
