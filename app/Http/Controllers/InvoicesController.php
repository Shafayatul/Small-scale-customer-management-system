<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Http\Request;
use App\Classes\invoicr;


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
        // foreach ($request->product_name as $key => $value) {
        //     $invoice               = new Invoice;
        //     $invoice->user_id      = $request->customer_id;
        //     $invoice->product_name = $value;
        //     $invoice->description  = $request->description[$key];
        //     $invoice->amount       = $request->amount[$key];
        //     $invoice->save();
        // }

        $product = 'dhfgdfjhg';
        $desc = 'djfhgjkdfhgkjdhfgjk';
        $price = '50';
        $their_practice = "jsdhfjksdhfjk";
        $their_address1 = "jsdhfjksdhfjk";
        $their_address2 = "jsdhfjksdhfjk";
        $due_date = date("y-m-d");


     
    //Create a new instance
    $pdf = new invoicr();
    $pdf->invoicr("A4","$","en");
    //Set number formatting
    $pdf->setNumberFormat('.',',');
    //Set your logo
    //$invoice->setLogo("http://www.dewebdesigns.com/images/logo.png");
    //Set theme color
    $pdf->setColor("#07569E");
    //Set type
    $pdf->setType("Invoice");
    //Set reference
    $ref = date('y-m-d').'-'.mt_rand(1,1000);
    $pdf->setReference($ref);
    //Set date
    $pdf->setDate(date('m/d/Y',time()));
    //Set due date
    $pdf->setDue($due_date);
    //Set from
    $pdf->setFrom(array("Devyn Earls, Inc.","4446-1A Hendricks Ave., Ste 224","Jacksonville, FL 32207"));
    //Set to
    $pdf->setTo(array($their_practice,$their_address1,$their_address2));
    //Add items
    $pdf->addItem($product,$desc,'','','','',$price);
    //Add items
    //$invoice->addItem("10% For Late Payment","Your payment was received x days late last month",'','','','',$price*.1);
    //Add totals
    $pdf->addTotal("Total due",$price,true);
    //Add Title
    $pdf->addTitle("Payment information");
    //Add Paragraph
    $pdf->addParagraph("Make all checks payable to:  Devyn Earls, Inc.<br>You can pay online with an additional 3% convience fee on my website: https://www.devynearlsinc.com<br><br>If you have any questions concerning this invoice, contact me at devyn@dewebdesigns.com.<br><br>Thank you for your business.");
    //Set footer note
    $pdf->setFooternote("http://www.devynearlsinc.com");
    //Render the PDF
    $pdf->render($ref.'.pdf','I');
        // $fpdf->AddPage();
        // $fpdf->Output();
        // $response = response($fpdf->Output('S'));
        // $response->header('Content-Type', 'application/pdf');

        // return $response;

        // return 'success';
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
