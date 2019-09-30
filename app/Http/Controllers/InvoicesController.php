<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
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
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    

    public function store(Request $request)
    {
        
        Invoice::where('user_id', $request->customer_id)->delete();

        foreach ($request->product_name as $key => $value) {
            $invoice               = new Invoice;
            $invoice->user_id      = $request->customer_id;
            $invoice->product_name = $value;
            $invoice->description  = $request->description[$key];
            $invoice->amount       = $request->amount[$key];
            $invoice->save();

        }

        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');

        if($request->is_save_and_email == '1'){
            $this->invoiceEmail($request->customer_id);
        }
        
        // dd($CustomersControllerref);
        $customer     = Customer::findOrFail($request->customer_id);
        $products     = Invoice::where('user_id', $request->customer_id)->get();
        $pdf = PDF::loadView('pdfs.invoice', compact('customer', 'products', 'ref', 'billing_date', 'due_date'));
        
        return $pdf->download('invoice.pdf');
        // return view('pdfs.invoice', compact('ref', 'billing_date', 'due_date', 'customer', 'products'));
    }


    public function invoiceEmail($id)
    {
        $customer     = Customer::findOrFail($id);
        $products     = Invoice::where('user_id', $id)->get();
        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');
        Mail::to($customer->email)->send(new InvoicePdf($customer, $products, $ref, $billing_date, $due_date));
        return true;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
