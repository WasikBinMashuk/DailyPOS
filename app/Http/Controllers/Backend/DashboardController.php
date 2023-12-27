<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Otp;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sell;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        $totalSells  = Sell::whereHas('branch', function ($query) {
            $query->where('default', 1);
        })->count();

        $totalDues  = Sell::whereHas('branch', function ($query) {
            $query->where('default', 1);
        })->whereHas('sellPayment', function ($query) {
            $query->where('due', '>', 0);
        })->count();

        $totalPurchases = Purchase::whereHas('branch', function ($query) {
            $query->where('default', 1);
        })->count();

        $totalPurchasePending = Purchase::whereHas('branch', function ($query) {
            $query->where('default', 1);
        })->where('status', 'pending')->count();

        $totalProducts = Stock::whereHas('branch', function ($query) {
            $query->where('default', 1);
        })->where('quantity', '>', '0')->count();

        $totalProductStockOut = Stock::whereHas('branch', function ($query) {
            $query->where('default', 1);
        })->where('quantity', '0')->groupBy('product_id')->count();

        $totalCustomers = Customer::count();

        $totalBlockedCustomers = Customer::where('status', 0)->count();

        return view('backend.dashboard', compact('totalSells', 'totalDues', 'totalPurchases', 'totalPurchasePending', 'totalProducts', 'totalProductStockOut', 'totalCustomers', 'totalBlockedCustomers'));
    }
}
