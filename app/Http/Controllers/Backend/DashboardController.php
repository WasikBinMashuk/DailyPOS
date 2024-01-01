<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Otp;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sell;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        $defaultBranch = Branch::where('default', 1)->first();

        $totalSells  = Sell::where('branch_id', $defaultBranch->id)->count();

        $totalDues  = Sell::where('branch_id', $defaultBranch->id)
            ->whereHas('sellPayment', function ($query) {
                $query->where('due', '>', 0);
            })->count();

        $totalPurchases = Purchase::where('branch_id', $defaultBranch->id)->count();

        $totalPurchasePending = Purchase::where('branch_id', $defaultBranch->id)->where('status', 'pending')->count();

        $totalProducts = Stock::where('branch_id', $defaultBranch->id)->where('quantity', '>', '0')->count();

        $totalProductStockOut = Stock::selectRaw('SUM(quantity) as total_quantity, product_id')
            ->where('branch_id', $defaultBranch->id)
            ->groupBy('product_id')
            ->havingRaw('SUM(quantity) = 0')
            ->count();

        $totalCustomers = Customer::count();

        $totalBlockedCustomers = Customer::where('status', 0)->count();

        return view('backend.dashboard', compact('totalSells', 'totalDues', 'totalPurchases', 'totalPurchasePending', 'totalProducts', 'totalProductStockOut', 'totalCustomers', 'totalBlockedCustomers'));
    }
}
