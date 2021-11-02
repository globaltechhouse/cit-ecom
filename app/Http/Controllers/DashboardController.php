<?php

namespace App\Http\Controllers;

use App\Models\BillingAmount;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    // Constructor
    public function __construct()
    {
        $this->middleware(['auth', 'administrator']);
    }

    public function index()
    {
        $neworder = BillingAmount::where('payment_status', 1)->count();
        $uniqueuser = Cart::all()->count();
        $usercount = User::all()->count();
        return view('backend.dashboard', compact('neworder', 'usercount', 'uniqueuser'));
    }
}
