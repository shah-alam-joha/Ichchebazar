<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
      public function index()
    {
        $products = Product::orderBy('id', 'desc')->simplePaginate(9);
        return view('frontend.pages.products.index', compact('products'));
    }

    public function show($slug)
    {
       $product = Product::where('slug', $slug)->first();
       
       if (!is_null($product)) {
          return view('frontend.pages.products.show',compact('product'));
       }
       else{
        session()->flash('errors', 'Sorry there is no product by this url..!!');
        return redirect()->route('products');
       }
       
    }
}
