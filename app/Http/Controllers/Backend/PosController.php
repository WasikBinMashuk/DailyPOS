<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sell;
use App\Models\SellDetail;
use App\Models\SellPayment;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PosController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::limit(20)->get();
        // return view('backend.pos.index', compact('products'));
        // $products = Product::paginate(12);
        $products = [];
        $categories = Category::all();
        $branches = Branch::all();

        // if ($request->ajax()) {
        //     $view = view('backend.pos.data', compact('products'))->render();
        //     return response()->json(['html' => $view]);
        // }

        return view('backend.pos.index', compact('products', 'categories', 'branches'));
    }

    public function productFetch(Request $request)
    {
        $products = Stock::with('product')->where('branch_id', $request->branch_id)->where('quantity', '>=', '1')
            ->select('product_id', DB::raw('SUM(quantity) as quantity'))
            ->groupBy('product_id')
            ->paginate(12);

        $view = view('backend.pos.data', compact('products'))->render();
        return response()->json(['html' => $view]);
    }

    public function autoCompleteCustomer(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $customers = Customer::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $customers = Customer::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', "%$search%")->orWhere('mobile', 'like', "%$search%")->limit(5)->get();
        }

        $response = array();
        foreach ($customers as $customer) {
            $response[] = array("value" => $customer->id, "label" => $customer->name);
        }
        // dd($response);
        return response()->json($response);
    }

    public function productFilter(Request $request)
    {
        if ($request->cid == 0) {
            $products = Stock::with('product')->where('branch_id', $request->branch_id)->where('quantity', '>=', '1')
                ->select('product_id', DB::raw('SUM(quantity) as quantity'))
                ->groupBy('product_id')
                ->paginate(12);
        } else {
            $products = Stock::with('product')->where('branch_id', $request->branch_id)->where('quantity', '>=', '1')
                ->whereHas('product', function ($query) use ($request) {
                    $query->where('category_id', $request->cid);
                })
                ->select('product_id', DB::raw('SUM(quantity) as quantity'))
                ->groupBy('product_id')
                ->get();
        }

        $view = view('backend.pos.data', compact('products'))->render();
        $responseData = ['html' => $view];

        // Add flag to response if $request->cid is 0
        if ($request->cid == 0) {
            $responseData['flag'] = 1;
        }

        return response()->json($responseData);
    }

    public function autoCompletePosProducts(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            // $products = Product::orderby('product_name', 'asc')->select('id', 'product_name', 'price', 'stock')->limit(5)->get();
            $products = Stock::with('product')->where('branch_id', $request->branch_id)->where('quantity', '>=', '1')
                ->select('product_id', DB::raw('SUM(quantity) as quantity'))
                ->groupBy('product_id')
                ->limit(5)->get();
        } else {
            // $products = Product::orderby('product_name', 'asc')->select('id', 'product_name', 'price', 'stock')->where('product_name', 'like', "%$search%")->orWhere('product_code', 'like', "%$search%")->limit(5)->get();

            $products = Stock::with('product')->where('branch_id', $request->branch_id)->where('quantity', '>=', '1')
                ->whereHas('product', function ($query) use ($search) {
                    $query->where('product_name', 'like', "%$search%")->orWhere('product_code', 'like', "%$search%");
                })
                ->select('product_id', DB::raw('SUM(quantity) as quantity'))
                ->groupBy('product_id')
                ->limit(5)
                ->get();
        }
        $response = array();
        foreach ($products as $product) {
            $response[] = array("value" => $product->product->id, "label" => $product->product->product_name, "price" => $product->product->price, "stock" => $product->quantity);
        }
        // dd($response);
        return response()->json($response);
    }

    public function storeData(Request $request)
    {
        // $stocks = Stock::where('product_id', $request->data[0]['product_id'])->orderBy('quantity', 'DESC')->get();
        // dd($stocks);
        // dd($request->data);
        if (!$request->filled('data')) {
            return response()->json(['errors' => 'no data found'], 406);
        }

        $validator = Validator::make($request->data[0], [
            'customer_id' => 'required|integer',
            'branch_id' => 'required|integer',
            'pay_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ], [
            'customer_id.required' => 'Field is required.',
        ]);
        if ($validator->fails()) {
            // $error = $validator->errors()->first();
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $sell = Sell::create([
            'customer_id' => $request->data[0]['customer_id'],
            'branch_id' => $request->data[0]['branch_id'],
            'subtotal' => $request->data[0]['subtotal'],
        ]);

        SellPayment::create([
            'sell_id' => $sell->id,
            'paid' => $request->data[0]['pay_amount'],
            'due' => $request->data[0]['due_amount'],
            'payment_method' => $request->data[0]['payment_method'],
            'subtotal' => $request->data[0]['subtotal'],
        ]);

        foreach ($request->data as $data) {
            $sellDetails[] = [
                'sell_id' => $sell->id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'total_price' => $data['total_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $quantity = $data['quantity'];
            $stocks = Stock::where('product_id', $data['product_id'])->orderBy('quantity', 'DESC')->get();
            foreach ($stocks as $stock) {
                if ($stock->quantity > 0) {
                    $updateStock = Stock::find($stock->id);
                    if ($stock->quantity >= $quantity && $stock->quantity != 0) {
                        $updateStock->update([
                            'quantity' => $stock->quantity - $quantity,
                        ]);
                        $quantity = 0;
                    } elseif ($stock->quantity < $quantity) {
                        $quantity = $quantity - $stock->quantity;
                        $updateStock->update([
                            'quantity' => 0,
                        ]);
                    }
                }

                $product = Product::where('id', $data['product_id'])->first();
                $product->update([
                    'stock' => $product->stock - $data['quantity'],
                ]);
            }
        }
        if (isset($sellDetails)) SellDetail::insert($sellDetails);

        // sweet alert
        // toast('Product Sold!', 'success');
        Alert::success('Product Sold!', '');

        return response()->json(['success' => true, 'message' => 'Product sold successfully']);
    }
}
