<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


function setNumberFormat($decimals,$thousands_sep)
    {
        $this->referenceformat = array($decimals,$thousands_sep);
    }

}

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

        $pdroduct = 'dhfgdfjhg';
        $desc = 'djfhgjkdfhgkjdhfgjk';
        $price = '50';
        $their_practice = 'jsdhfjksdhfjk';
        $their_address1 = 'jsdhfjksdhfjk';
        $their_address2 = 'jsdhfjksdhfjk';
        $due_date = date("y-m-d");


        $fpdf = new Fpdf('P','mm','A4');
        $fpdf->AddPage();
        // $fpdf->setNumberFormat('.',',');
        $fpdf->SetTextColor(0,0,0);
        $fpdf->setTitle("Invoice");
        $ref = date('y-m-d').'-'.mt_rand(1,1000);
        // $fpdf->setReference($ref);
        // $fpdf->setDate(date('m/d/Y',time()));
        // $fpdf->setDue($due_date);
        // $fpdf->setFrom(array("Devyn Earls, Inc.","4446-1A Hendricks Ave., Ste 224","Jacksonville, FL 32207"));
        // $fpdf->setTo(array($their_practice,$their_address1,$their_address2));
        // $fpdf->addItem($product,$desc,'','','','',$price);
        // $fpdf->addTotal("Total due",$price,true);
        // $fpdf->addTitle("Payment information");
        // $fpdf->addParagraph("Make all checks payable to:  Devyn Earls, Inc.<br>You can pay online with an additional 3% convience fee on my website: https://www.devynearlsinc.com<br><br>If you have any questions concerning this invoice, contact me at devyn@dewebdesigns.com.<br><br>Thank you for your business.");
        $fpdf->setFooternote("http://www.devynearlsinc.com");
        $fpdf->Output();
        $response = response($fpdf->Output('S'));
        $response->header('Content-Type', 'application/pdf');

        return $response;

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
