<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with(['branch', 'product'])->orderBy('date', 'desc')->paginate(10);
        return view('backend.stocks.index', compact('stocks'));
    }
}
