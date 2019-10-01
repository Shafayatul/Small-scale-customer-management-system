<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Invoice;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $last_year_invoices = Invoice::whereDate('created_at', '>', Carbon::now()->subDays(365))->get();
        $last_month_invoices           = Invoice::whereDate('created_at', '>', Carbon::now()->subDays(30))->get();
        $last_month_paid    = 0;
        $last_month_unpaid  = 0;
        $last_month_total   = 0;
        $last_year_total   = 0;
        foreach ($last_month_invoices as $last_month_invoice) {
            if ($last_month_invoice->is_paid == 1) {
                $last_month_paid = $last_month_paid  + $last_month_invoice->total_amount; 
            }else{
                $last_month_unpaid = $last_month_unpaid  + $last_month_invoice->total_amount; 
            }
        }
        $last_month_total   = $last_month_paid + $last_month_unpaid;


        foreach ($last_year_invoices as $last_year_invoice) {
            $last_year_total = $last_year_total + $last_year_invoice->total_amount; 
        }
        return view('home', compact('last_month_paid','last_month_unpaid','last_month_total','last_year_total'));
    }
}
