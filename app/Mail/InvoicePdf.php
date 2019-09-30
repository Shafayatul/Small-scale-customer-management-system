<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoicePdf extends Mailable
{
    use Queueable, SerializesModels;
    public $customer, $products, $ref, $billing_date, $due_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $products, $ref, $billing_date, $due_date)
    {
        $this->customer     = $customer;
        $this->products     = $products;
        $this->ref          = $ref;
        $this->billing_date = $billing_date;
        $this->due_date     = $due_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invoice');
    }
}
