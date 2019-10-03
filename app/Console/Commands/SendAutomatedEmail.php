<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Invoice;
use App\Product;
use App\Customer;
use PDF;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceEmailReminder;

class SendAutomatedEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Senidng automated unpaid emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today       = Carbon::now()->format('d');
        $today_date  = Carbon::now()->format('Y-m-d');
        $invoice_ids = Invoice::where('autometic_email_day', $today)
                                ->where('is_autometic', '1')
                                ->where('is_paid', '0')
                                ->where('last_email_date', '!=', $today_date)
                                ->pluck('id');

        \Log::debug($invoice_ids);
        foreach ($invoice_ids as $key => $value) {
            $this->invoiceEmailReminder($value);
        }
    }



    public function invoiceEmailReminder($id)
    {
        $invoice      = Invoice::findOrFail($id);
        $invoice->last_email_date = date("Y-m-d");
        $invoice->save();

        $customer     = Customer::where('id',$invoice->user_id)->first();
        $products     = Product::where('invoice_id', $id)->get();
        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::parse($invoice->created_at)->format('d/m/Y');
        $due_date     = Carbon::parse($invoice->created_at)->format('d/m/Y');

        $pdf = PDF::loadView('pdfs.invoice', compact('customer', 'products', 'ref', 'billing_date', 'due_date'));
        $pdf = $pdf->output();

        Mail::to($customer->email)->send(new InvoiceEmailReminder($customer, $products, $ref, $billing_date, $due_date, $pdf));

        return redirect('/customers/'.$invoice->user_id)->with('success', 'Sent Email Successfully!');
    }

}
