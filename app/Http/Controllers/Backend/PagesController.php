<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use Image;

class PagesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }
    
       public function index()
    {
        // $products = Product::orderBy('id', 'desc')->get();
        // return view('backend.pages.product.index', compact('products'));
        return view('backend.index');
    } 
}
