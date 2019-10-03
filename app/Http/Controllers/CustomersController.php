<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePdf;
use App\Mail\InvoiceEmailReminder;
use Carbon\Carbon;
use PDF;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $customers = Customer::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('business_name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('state', 'LIKE', "%$keyword%")
                ->orWhere('zip', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customers = Customer::latest()->paginate($perPage);
        }
        return view('customers.index', compact('customers'));
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
        $customer = new Customer;
        return view('customers.create', compact('days', 'customer'));
    }

    public function invoiceCreate($id)
    {
        $days = [
            '0' => '--Select Day--', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' =>'16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28'
        ];
        $customer = Customer::findOrFail($id);
        $products = Product::where('user_id', $id)->get();
        return view('invoices.create', compact('customer', 'products', 'days'));
    }

    public static function invoiceEmail($id)
    {
        $customer     = Customer::findOrFail($id);
        $products     = Product::where('user_id', $id)->get();
        $ref          = date('y-m-d').'-'.mt_rand(1,1000);
        $billing_date = Carbon::today()->format('d/m/Y');
        $due_date     = Carbon::today()->format('d/m/Y');
        Mail::to($customer->email)->send(new InvoicePdf($customer, $products, $ref, $billing_date, $due_date));
        // return redirect()->back()->with('success', 'Successfully Sent Email!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

        if($request->is_save_and_email == '1'){
            $last_email_date = Carbon::today()->format('Y-m-d');
        }else{
            $last_email_date = null;
        }

        $customer                  = new Customer;
        $customer->name            = $request->name;
        $customer->email           = $request->email;
        $customer->phone_number    = $request->phone_number;
        $customer->business_name   = $request->business_name;
        $customer->address         = $request->address;
        $customer->city            = $request->city;
        $customer->state           = $request->state;
        $customer->zip             = $request->zip;
        $customer->is_invoice_auto = $is_autometic;
        $customer->days            = $request->days;
        $customer->invoice_email   = $request->invoice_email;
        $customer->save();


        $sum_amount = 0;
        foreach ($request->amount as $key => $value) {
            $sum_amount += $value;
        }

        $invoice                      = new Invoice;
        $invoice->user_id             = $customer->id;
        $invoice->is_autometic        = $is_autometic;
        $invoice->autometic_email_day = $request->days;
        $invoice->invoice_email       = $request->invoice_email;
        $invoice->total_amount        = $sum_amount;

        $invoice->is_paid             = 0;
        $invoice->last_email_date     = $last_email_date;
        $invoice->save();

        foreach ($request->product_name as $key => $value) {
            $product               = new Product;
            $product->invoice_id   = $invoice->id;
            $product->user_id      = $customer->id;
            $product->product_name = $value;
            $product->description  = $request->description[$key];
            $product->amount       = $request->amount[$key];
            $product->save();
        }

        return redirect('/home')->with('success', 'Customer added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $invoices = Invoice::where('user_id', $id)->get();
        return view('customers.show', compact('customer', 'invoices'));
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
        $customer = Customer::findOrFail($id);
        $products = [];
        $invoice_count = Invoice::where('user_id', $id)->where('is_autometic', '1')->count();
        if ($invoice_count != 0) {
            $invoice_id = Invoice::where('user_id', $id)->where('is_autometic', '1')->first()->id;
            $products = Product::where('user_id', $id)->where('invoice_id', $invoice_id)->get();
        }


        return view('customers.edit', compact('customer', 'days', 'products'));
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

        if($request->is_save_and_email == '1'){
            $last_email_date = Carbon::today()->format('Y-m-d');
        }else{
            $last_email_date = null;
        }


        $customer = Customer::findOrFail($id);
        $customer->name            = $request->name;
        $customer->email           = $request->email;
        $customer->phone_number    = $request->phone_number;
        $customer->business_name   = $request->business_name;
        $customer->address         = $request->address;
        $customer->city            = $request->city;
        $customer->state           = $request->state;
        $customer->zip             = $request->zip;
        $customer->is_invoice_auto = $is_autometic;
        $customer->days            = $request->days;
        $customer->invoice_email   = $request->invoice_email;
        $customer->save();

        if ($is_autometic == 1) {

            $sum_amount = 0;
            foreach ($request->amount as $key => $value) {
                $sum_amount += $value;
            }

            $count = Invoice::where('user_id', $customer->id)->where('is_autometic', '1')->count();

            if ($count == 0) {
                $invoice                      = new Invoice;
            }else{
                $invoice_id                   = Invoice::where('id', $customer->id)->first()->id;
                $invoice                      = Invoice::findOrFail($invoice_id);
            }

            $invoice->user_id             = $customer->id;
            $invoice->is_autometic        = $is_autometic;
            $invoice->autometic_email_day = $request->days;
            $invoice->invoice_email       = $request->invoice_email;
            $invoice->total_amount        = $sum_amount;
            if ($count == 0) {
                $invoice->is_paid             = 0;
            }else{
                $invoice->is_paid             = $invoice->is_paid;
            }
            $invoice->last_email_date     = $last_email_date;
            $invoice->save();

            $sd = Product::where('user_id', $customer->id)->where('invoice_id', $invoice->id)->delete();
            foreach ($request->product_name as $key => $value) {
                $product               = new Product;
                $product->invoice_id   = $invoice->id;
                $product->user_id      = $customer->id;
                $product->product_name = $request->product_name[$key];
                $product->description  = $request->description[$key];
                $product->amount       = $request->amount[$key];
                $product->save();
                echo $product->product_name;
            }
        }
        return redirect('/home')->with('success', 'Customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('user_id', $id)->delete();
        Invoice::where('user_id', $id)->delete();
        Customer::destroy($id);
        return redirect('customers')->with('success', 'Customer deleted!');
    }
}
