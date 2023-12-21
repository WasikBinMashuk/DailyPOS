<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Sell;
use App\Models\SellDetail;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = Branch::where('default', 1)->first();
        $sells = Sell::with(['sellPayment', 'customer'])->where('branch_id', $branch->id)->latest()->paginate(10);

        return view('backend.sell.index', compact('sells', 'branch'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sellDetails = SellDetail::with(['product'])->where('sell_id', $id)->get();
        return view('backend.sell.sellDetails', compact('sellDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
