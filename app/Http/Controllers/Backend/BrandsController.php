<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use File;
class BrandsController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth:admin');
    }
    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('backend.pages.brand.index', compact('brands'));
    }

    public function create()
    {
     return view('backend.pages.brand.create');
 }
 public function store(Request $request)
 {
     $this->validate( $request, [
        'name' => 'required',
        'description'=> 'nullable',
        'image' => 'nullable|image',
    ],
    [ 
        'name.required' => 'Please provide a brand name',
        'image.image' => ' Please provide a valid image with .jpg, .png extension',

    ]);

     $brand = new Brand();
     $brand->name = $request->name;
     $brand->description = $request->description;

     if ( $request->hasFile('image') > 0) {
         $image = $request->file('image');
         $img = time(). '.'. $image->getClientOriginalExtension();
         $location = 'images/brands/'.$img;
         Image::make($image)->save($location);
         $brand->image = $img;
     }
     $brand->save();

     session()->flash('success', 'A brand has add successfully.');
     return redirect()->route('admin.brands');
 }

 public function edit($id)
 {
    $brand = Brand::find($id);
    return view('backend.pages.brand.edit', compact('brand'));
}
public function update(Request $request , $id)
{

 $this->validate($request, [
    'name' => 'nullable',
    'description' => 'nullable',
    'image' => 'nullable|image',
], 
[
    'image.image' => 'Please provide a valid image with .jpg , .png extension.',
]);

 $brand = Brand::find($id);
 $brand->name = $request->name;
 $brand->description = $request->description;

 if ($request->hasFile('image') > 0) {
    if (File::exists('images/brands/'.$brand->image)) {
       File::delete('images/brands/'.$brand->image);
    }

    $image = $request->file('image');
    $img = time(). '.'.$image->getClientOriginalExtension();
    $location = 'images/brands/'.$img;
    Image::make($image)->save($location);
    $brand->image = $img;
 }

 $brand->save();

 session()->flash('success', 'Brand has updated successfully');
 return redirect()->route('admin.brands');
}
public function delete($id)
{
    $brand = Brand::find($id);
    if (!is_null($brand)) {
        $brand->delete();
    }
    session()->flash('success', 'Brand has deleted successfully');
 return redirect()->route('admin.brands');
}

}
