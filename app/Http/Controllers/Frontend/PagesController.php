<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;

class PagesController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->simplePaginate(9);
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('frontend.pages.index',compact('products', 'sliders'));
    }
    public function contact()
    {
        return view('frontend.contact');
    } 

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::orWhere('title', 'like', '%'. $search .'%')
        ->orWhere('description', 'like', '%'. $search .'%')
        ->orWhere('slug', 'like', '%'. $search .'%')
        ->orWhere('quantity', 'like', '%'. $search .'%')
        ->orWhere('price', 'like', '%'. $search .'%')
        ->simplePaginate(9);

        return view('frontend.pages.products.search', compact('search', 'products'));
    }
     
    
}
