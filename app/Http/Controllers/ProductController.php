<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->first(); 
        return view('components.products', compact('products'));
    }

    public function pulpProcess()
    {
        return view('pulp_process');
    }
}