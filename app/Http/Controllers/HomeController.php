<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Invoice;
use App\Customer;
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
    public function index(Request $request)
    {
        $last_year_invoices  = Invoice::whereDate('created_at', '>', Carbon::now()->subDays(365))->get();
        $last_month_invoices = Invoice::whereDate('created_at', '>', Carbon::now()->subDays(30))->get();
        $last_month_paid     = 0;
        $last_month_unpaid   = 0;
        $last_month_total    = 0;
        $recurring_invoice   = 0;
        $last_year_total     = 0;
        $paid_invoice_per_day= []; // for graph

        foreach ($last_month_invoices as $last_month_invoice) {
            if ($last_month_invoice->is_paid == 1) {

                $last_month_paid   = $last_month_paid  + $last_month_invoice->total_amount;

                // paid invoice graph
                if (array_key_exists($last_month_invoice->created_at->format('M d'), $paid_invoice_per_day)) {
                    $paid_invoice_per_day[$last_month_invoice->created_at->format('M d')] = $paid_invoice_per_day[$last_month_invoice->created_at->format('M d')] + $last_month_invoice->total_amount;
                }else{
                    $paid_invoice_per_day[$last_month_invoice->created_at->format('M d')] = $last_month_invoice->total_amount;
                }

            }else{
                $last_month_unpaid = $last_month_unpaid  + $last_month_invoice->total_amount;
            }

            // recurring total
            if ($last_month_invoice->is_autometic == 1) {
                $recurring_invoice = $recurring_invoice + $last_month_invoice->total_amount;
            }

        }
        $last_month_total   = $last_month_paid + $last_month_unpaid;



        foreach ($last_year_invoices as $last_year_invoice) {
            $last_year_total = $last_year_total + $last_year_invoice->total_amount; 
        }

        // customer list
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
        return view('home', compact('last_month_paid','last_month_unpaid','last_month_total','last_year_total', 'customers', 'paid_invoice_per_day', 'recurring_invoice'));
    }
}
