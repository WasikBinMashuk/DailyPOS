<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;
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
        // dd($request->data);

        $validator = Validator::make($request->data[0], [
            'supplier_id' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|string',
            'payment_method' => 'required|string',
        ]);
        if ($validator->fails()) {
            // $error = $validator->errors()->first();
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $purchase = Purchase::create([
            'supplier_id' => $request->data[0]['supplier_id'],
            'date' => $request->data[0]['date'],
            'status' => $request->data[0]['status'],
            'payment_method' => $request->data[0]['payment_method'],
            'subtotal' => $request->data[0]['subtotal'],
        ]);
        foreach ($request->data as $data) {
            $details[] = [
                'purchase_id' => $purchase->id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'total_price' => $data['total_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $product = Product::where('id', $data['product_id'])->first();
            $product->update([
                'stock' => $product->stock + $data['quantity'],
            ]);

            Stock::create([
                'product_id' => $data['product_id'],
                'source' => "supplier",
                'quantity' => $data['quantity'],
            ]);
        }
        if (isset($details)) PurchaseDetail::insert($details);

        // sweet alert
        toast('New Purchase Added!', 'success');

        return response()->json(['success' => true, 'message' => 'Data stored successfully']);
    }

    public function autoComplete(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $products = Product::orderby('product_name', 'asc')->select('id', 'product_name', 'price')->limit(5)->get();
        } else {
            $products = Product::orderby('product_name', 'asc')->select('id', 'product_name', 'price')->where('product_name', 'like', "%$search%")->limit(5)->get();
        }

        $response = array();
        foreach ($products as $product) {
            $response[] = array("value" => $product->id, "label" => $product->product_name, "price" => $product->price);
        }
        // dd($response);
        return response()->json($response);
    }
}
