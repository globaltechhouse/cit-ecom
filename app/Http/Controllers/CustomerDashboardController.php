<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\Profile;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }
    public function index()
    {

        $bills = BillingDetail::where('user_id', auth()->id())->get();
        $lastbill = BillingDetail::where('user_id', auth()->id())->orderBY('created_at', 'desc')->first();
        return view('frontend.pages.myAccount', compact('bills', 'lastbill'));
    }

    public function viewInvoice(BillingDetail $bill)
    {
        if (url()->previous() == 'http://127.0.0.1:8000/myaccount') {
            return view('frontend.pages.invoice_View', compact('bill'));
        }
        return redirect()->route('customer.dashboard');
    }

    public function downloadInvoice(BillingDetail $bill)
    {
        $pdf = PDF::loadView('frontend.pages.download.invoice', compact('bill'));
        return $pdf->download('invoice.pdf');
    }
}
