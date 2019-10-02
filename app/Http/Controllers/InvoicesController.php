<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use App\Product;
use App\Customer;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Http\Controllers\CustomersController;

use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePdf;



class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days = [
            '0' => '--Select Day--', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' =>'16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28'
        ];
        return view('invoices.create', compact('days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    

    public function store(Request $request)
    {
        $sum_amount = 0;
        foreach ($request->amount as $key => $value) {
            $sum_amount += $value;
        }


        if($request->is_save_and_email == '1'){
            $last_email_date = Carbon::today()->format('Y-m-d');
        }else{
            $last_email_date = null;
        }

        if($request->is_paid == '1'){
            $is_paid = 1;
        }else{
            $is_paid = 0;
        }

        if (isset($request->is_autometic)) {
            $is_autometic = 1;
        }else{
            $is_autometic = 0;
        }

        $invoice                      = new Invoice;
        $invoice->user_id             = $request->customer_id;
        $invoice->is_autometic        = $is_autometic;
        $invoice->autometic_email_day = $request->autometic_email_day;
        $invoice->invoice_email       = $request->invoice_email;
        $invoice->total_amount        = $sum_amount;
        $invoice->is_paid             = $is_paid;
        $invoice->last_email_date     = $last_email_date;
        $invoice->save();

        foreach ($request->product_name as $key => $value) {
            $product               = new Product;
            $product->invoice_id   = $invoice->id;
            $product->user_id      = $request->customer_id;
            $product->product_name = $value;
            $product->description  = $request->description[$key];
            $product->amount       = $request->amount[$key];
            $product->save();

        }

        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');

        if($request->is_save_and_email == '1'){
            $this->invoiceEmail($invoice->id);
        }

        $customer     = Customer::findOrFail($request->customer_id);
        $products     = Product::where('user_id', $request->customer_id)->where('invoice_id', $invoice->id)->get();
        $pdf = PDF::loadView('pdfs.invoice', compact('customer', 'products', 'ref', 'billing_date', 'due_date'));
        
        return $pdf->download('invoice.pdf');
    }


    public function invoiceEmail($id)
    {
        $invoice      = Invoice::findOrFail($id);
        $customer     = Customer::where('id',$invoice->user_id)->first();
        $products     = Product::where('invoice_id', $id)->get();
        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');
        Mail::to($customer->email)->send(new InvoicePdf($customer, $products, $ref, $billing_date, $due_date));
        return true;
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
        Mail::to($customer->email)->send(new InvoicePdf($customer, $products, $ref, $billing_date, $due_date));

        return redirect('/customers/'.$invoice->user_id)->with('success', 'Sent Email Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function pdfView($id){
        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');
        $invoice      = Invoice::findOrFail($id);
        $customer     = Customer::findOrFail($invoice->user_id);
        $products     = Product::where('user_id', $invoice->user_id)->where('invoice_id', $invoice->id)->get();
        $pdf          = PDF::loadView('pdfs.invoice', compact('customer', 'products', 'ref', 'billing_date', 'due_date'));
        return $pdf->stream($ref.'.pdf');
    }

    public function pdfDownload($id)
    {
        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');
        $invoice      = Invoice::findOrFail($id);
        $customer     = Customer::findOrFail($invoice->user_id);
        $products     = Product::where('user_id', $invoice->user_id)->where('invoice_id', $invoice->id)->get();
        $pdf          = PDF::loadView('pdfs.invoice', compact('customer', 'products', 'ref', 'billing_date', 'due_date'));
        return $pdf->download($ref.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $days = [
            '0' => '--Select Day--', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' =>'16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28'
        ];
        $invoice      = Invoice::findOrFail($id);
        $products     = Product::where('user_id', $invoice->user_id)->where('invoice_id', $invoice->id)->get();
        return view('invoices.edit', compact('invoice', 'products', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Product::where('invoice_id', $id)->delete();

        $sum_amount = 0;
        foreach ($request->amount as $key => $value) {
            $sum_amount += $value;
        }

        if (isset($request->is_autometic)) {
            $is_autometic = 1;
        }else{
            $is_autometic = 0;
        }

        if($request->is_paid == '1'){
            $is_paid = 1;
        }else{
            $is_paid = 0;
        }


        $invoice                      = Invoice::findOrFail($id);
        $invoice->total_amount        = $sum_amount;
        $invoice->is_autometic        = $is_autometic;
        $invoice->autometic_email_day = $request->autometic_email_day;
        $invoice->invoice_email       = $request->invoice_email;
        $invoice->is_paid             = $is_paid;
        $invoice->save();

        $customer                  = Customer::where('id', $invoice->user_id)->first();
        $customer->is_invoice_auto = $is_autometic;
        $customer->days            = $request->autometic_email_day;
        $customer->invoice_email   = $request->invoice_email;
        $invoice->is_paid          = $is_paid;
        $customer->save();

        foreach ($request->product_name as $key => $value) {
            $product               = new Product;
            $product->invoice_id   = $invoice->id;
            $product->user_id      = $invoice->user_id;
            $product->product_name = $value;
            $product->description  = $request->description[$key];
            $product->amount       = $request->amount[$key];
            $product->save();

        }

        return redirect('/customers/'.$invoice->user_id)->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice          = Invoice::findOrFail($id);
        Product::where('invoice_id', $id)->delete();
        Invoice::destroy($id);
        return redirect('/customers/'.$invoice->user_id)->with('success', 'Invoice Updated!');
    }

    public function unpaid($id)
    {
        $invoice          = Invoice::findOrFail($id);
        $invoice->is_paid = 0;
        $invoice->save();
        return redirect('/customers/'.$invoice->user_id)->with('success', 'Invoice Updated!');
    }

    public function paid($id)
    {
        $invoice          = Invoice::findOrFail($id);
        $invoice->is_paid = 1;
        $invoice->save();
        return redirect('/customers/'.$invoice->user_id)->with('success', 'Invoice Updated!');
    }
}
