<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use Image;
use File;

class ProductsController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth:admin');
 }
 public function index()
 {
    return view('backend.index');
} 

public function products()
{
    $products = Product::orderBy('id', 'desc')->get();
    return view('backend.pages.product.index', compact('products'));
}  

public function edit($id)
{
    $product = Product::find($id);
    return view('backend.pages.product.edit', compact('product'));
} 

public function create()
{
    return view('backend.pages.product.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required | max:100',
        'price' => 'required | numeric',
        'description' => 'required',
        'quantity' => 'required | numeric',

        'category_id' => 'required | numeric',
        'brand_id' => 'required | numeric',

    ]);

    $product = new Product;
    $product->title = $request->title;
    $product->description = $request->description;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->admin_id = 1;
    $product->quantity = $request->quantity;
    $product->status = 1;
    $product->slug = Str::slug($request->title);
    $product->offer_price = $request->offer_price;
    $product->price = $request->price;
    $product->save();



        // insert image into ProductImage model

        // if ($request->hasFile('product_image')) {

        //     $image = $request->file('product_image');
        //     $img = time(). '.' .$image->getClientOriginalExtension();
        //     $location = 'images/products/'.$img;
        //     Image::make($image)->save($location);

        //     //insert into database
        //     $product_image = new ProductImage;
        //     $product_image->product_id = $product->id;
        //     $product_image->image = $img;
        //     $product_image->save();
        // }

    if ($request->product_image > 0) {

      foreach ($request->product_image as $image) {

        //insert that image
        //$image = $request->file('product_image');
        $img = time() . '.' . $image->getClientOriginalExtension();
        $location = 'images/products/' . $img;
        Image::make($image)->save($location);

        $product_image = new ProductImage;
        $product_image->product_id = $product->id;
        $product_image->image = $img;
        $product_image->save();
        
    }

        // if ( count($request->product_image) > 0) {
        //     foreach ($request->product_image as $image) {
        //         $img = time(). '.' . $image->getClientOriginalExtension();
        //         $location = 'images/products/'. $img;
        //         Image::make($image)->save($location);

        //         $product_image = new ProductImage;
        //         $product_image->product_id = $product->id;
        //         $product_image->image = $img;
        //         $product_image->save();
        //     }
        // }


    session()->flash('success', 'A product has been stored successfully !!');
    return redirect()->route('admin.products');

}
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required | max:100',
        'price' => 'required | numeric',
        'description' => 'required',
        'quantity' => 'required | numeric',

    ]);

    $product = Product::find($id);

    $product->title = $request->title;
    $product->description = $request->description;
    $product->quantity = $request->quantity;
    $product->price = $request->price;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;


    // if ( $request->hasFile('image') > 0) {

    //     if (File::exists('images/products/'. $product->image)) {
    //         File::delete('images/products/'. $product->image);
    //         dd($product->image);
    //     }

    //     $image = $request->file('image');
    //     $img = time(). '.'. $image->getClientOriginalExtension();
    //     $location = 'images/products/'. $img;
    //     Image::make($image)->save($location);
    //     $product->image = $img;
    // }

    if ($request->product_image > 0) {

       //delete this product image
        if (File::exists('images/products/'. $product->image)) {
            File::delete('images/products/'. $product->image);
        }


        foreach ($request->product_image as $image) {

        //insert that image
        //$image = $request->file('product_image');
        $img = time() . '.' . $image->getClientOriginalExtension();
        $location = 'images/products/' . $img;
        Image::make($image)->save($location);

        $product_image = new ProductImage;
        $product_image->product_id = $product->id;
        $product_image->image = $img;
        $product_image->save();
        
    }


    }

$product->save();

session()->flash('success', 'The product has been updated successfully !!');
return redirect()->route('admin.products', compact('product'));


}

public function delete($id)
{
    $product = Product::find($id);
    if (!is_null($product)) {
      $product->delete();
  }
    // Delete all images
  foreach ($product->image as $img) {
      // Delete from path
      $file_name = $img->image;
      if (file_exists("images/products/" . $file_name)) {
        unlink("images/products/" . $file_name);
    }

    $img->delete();
}
session()->flash('success', 'Product has deleted successfully !!');
return back();
}
}
