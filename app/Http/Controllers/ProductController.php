<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function show($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }
}
