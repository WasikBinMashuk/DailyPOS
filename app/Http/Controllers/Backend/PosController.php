<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::limit(20)->get();
        // return view('backend.pos.index', compact('products'));
        $products = Product::paginate(12);
        $categories = Category::all();

        if ($request->ajax()) {
            $view = view('backend.pos.data', compact('products'))->render();
            return response()->json(['html' => $view]);
        }

        return view('backend.pos.index', compact('products', 'categories'));
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
            $products = Product::paginate(12);
        } else {
            $products = Product::where('category_id', $request->cid)->get();
        }

        $view = view('backend.pos.data', compact('products'))->render();
        $responseData = ['html' => $view];

        // Add flag to response if $request->cid is 0
        if ($request->cid == 0) {
            $responseData['flag'] = 1;
        }

        return response()->json($responseData);
    }
}
