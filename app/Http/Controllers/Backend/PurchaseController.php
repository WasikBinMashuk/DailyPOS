<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('backend.purchases.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function formSubmit(Request $request)
    {

        // Validate the request data
        // $validatedData = $request->validate([
        //     'supplier_id' => 'required|integer',
        //     'product_name' => 'required|string',
        //     'quantity' => 'required|integer',
        //     'price' => 'required|numeric',
        // ]);
        // Save the data to the database or perform other actions as needed

        // $validated = $request->validated();
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|integer',
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            // $error = $validator->errors()->first();
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'supplier_id' => $request->supplier_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total_price' => $request->price * $request->quantity,
        ];

        return response()->json(['message' => 'Successfully created', 'code' => 200, 'data' => $data]);
    }

    public function storeData(Request $request)
    {
        // dd($request->toArray());
        // Loop through the submitted data and store it in the database
        // foreach ($request->all() as $data) {
        //     YourModel::create([
        //         'supplier' => $data['supplier'],
        //         'product' => $data['product'],
        //         'quantity' => $data['quantity'],
        //         'price' => $data['price'],
        //     ]);
        // }
        // sweet alert
        toast('Data Updated!', 'success');
        return redirect()->route('purchases.create');
        // return response()->json(['success' => true, 'message' => 'Data stored successfully']);
    }
}
