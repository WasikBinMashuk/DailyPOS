<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::limit(20)->get();
        // dd($products);
        return view('backend.pos.index', compact('products'));
    }
}
