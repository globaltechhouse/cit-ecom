<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $billings = BillingDetail::orderBY('created_at', 'desc')->get();
        return view('backend.order.index', compact('billings'));
    }
    public function singleOrder(BillingDetail $billing)
    {
        // return $billing;
        return view('backend.order.details', compact('billing'));
    }
}
