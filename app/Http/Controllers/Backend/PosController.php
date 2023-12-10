<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        if ($request->ajax()) {
            $view = view('backend.pos.data', compact('products'))->render();
            return response()->json(['html' => $view]);
        }

        return view('backend.pos.index', compact('products', 'categories', 'branches'));
    }

    public function productFetch(Request $request)
    {
        // $products = Product::paginate(12);
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
}
