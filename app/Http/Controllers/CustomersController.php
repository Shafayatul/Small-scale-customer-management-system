<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePdf;
use Carbon\Carbon;

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
        $customer = Customer::findOrFail($id);
        $products = Invoice::where('user_id', $id)->get();
        return view('invoices.create', compact('customer', 'products'));
    }

    public static function invoiceEmail($id)
    {
        $customer     = Customer::findOrFail($id);
        $products     = Invoice::where('user_id', $id)->get();
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

        if(isset($request->is_invoice_auto)){
            $is_invoice_auto = 1;
        }else{
            $is_invoice_auto = 0;
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
        $customer->monthly_payment = $request->monthly_payment;
        $customer->is_paid         = $request->is_paid;
        $customer->is_invoice_auto = $is_invoice_auto;
        $customer->days            = $request->days;
        $customer->invoice_email   = $request->invoice_email;
        $customer->save();


        return redirect(url('customer-invoice/'.$customer->id))->with('success', 'Customer added!');
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

        return view('customers.show', compact('customer'));
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

        return view('customers.edit', compact('customer', 'days'));
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
        $customer = Customer::findOrFail($id);

        if(isset($request->is_invoice_auto)){
            $is_invoice_auto = 1;
        }else{
            $is_invoice_auto = 0;
        }

        $customer->name            = $request->name;
        $customer->email           = $request->email;
        $customer->phone_number    = $request->phone_number;
        $customer->business_name   = $request->business_name;
        $customer->address         = $request->address;
        $customer->city            = $request->city;
        $customer->state           = $request->state;
        $customer->zip             = $request->zip;
        $customer->monthly_payment = $request->monthly_payment;
        $customer->is_paid         = $request->is_paid;
        $customer->is_invoice_auto = $is_invoice_auto;
        $customer->days            = $request->days;
        $customer->invoice_email   = $request->invoice_email;
        $customer->save();

        return redirect('customers')->with('success', 'Customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect('customers')->with('success', 'Customer deleted!');
    }
}
