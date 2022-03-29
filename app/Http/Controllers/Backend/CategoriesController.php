<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use File;

class CategoriesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }
    // public function index()
    // {
    //     $categories = Category::orderBy('id', 'desc')->get();
    //     return view('backend.pages.category.index', compact('categories'));
    // }

   public function index()
   {
    $categories = Category::orderBy('id', 'desc')->get();
    return view ('backend.pages.category.index', compact('categories'));
}

public function create()
{
    $main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    return view('backend.pages.category.create', compact('main_categories'));
}

public function store(Request $request)
{
    $this->validate( $request, [

        'name' => 'required',
        'image' => 'nullable|image',

    ],
    [
        'name.required' => 'Please provide a valid name',
        'image.image' => 'Please provide a valid image with .jpg , .png extension.',
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;
    $category->parent_id = $request->parent_id;


    if ( $request->hasFile('image')  > 0) {

        $image = $request->file('image');
        $img = time(). '.'. $image->getClientOriginalExtension();
        $location = 'images/categories/'. $img;
        Image::make($image)->save($location);
        $category->image = $img;
    }
    $category->save();

    session()->flash('success', 'A new category has been added successfully .!!');
    return redirect()->route('admin.categories');
}

public function edit($id)
{
    $category = Category::find($id);
    $main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    return view('backend.pages.category.edit', compact('category', 'main_categories'));
}
public function update(Request $request, $id)
{

    $this->validate( $request, [
        'name' => 'required',
        'image' => 'nullable | image',
    ],
    [
        'name.required' => 'Please provide a category name',
        'image.image' => 'Please provide a valid image with .jph, .png extension.',
    ]);

    $category = Category::find($id);
    $category->name = $request->name;
    $category->description = $request->description;
    $category->parent_id = $request->parent_id;

    if ( $request->hasFile('image') > 0) {

        if (File::exists('images/categories/'. $category->image)) {
            File::delete('images/categories/'. $category->image);
        }

        $image = $request->file('image');
        $img = time(). '.'. $image->getClientOriginalExtension();
        $location = 'images/categories/'. $img;
        Image::make($image)->save($location);
        $category->image = $img;
    }
    $category->save();

    session()->flash('success', 'category has beed updated successfully .!!');
    return redirect()->route('admin.categories');
}

public function delete($id)
{
    $category = Category::find($id);

    if(!is_null($category))
    {
        // if this is a parent category
        if ($category->parent_id == NULL) {

            //find sub category under this parent category
            $sub_categories = Category::orderBy('name', 'desc')->where('parent_id', $category->id)->get();
           
           foreach ($sub_categories as $sub) {
               if (File::exists('images/categories/'. $sub->image)) {
                   File::delete('images/categories/'. $sub->image);
               }
               $sub->delete();
           }
        }
        if(File::exists('images/categories/'.$category->image)){
            File::delete('images/categories/'.$category->image);
        }
        $category->delete();
    }
    session()->flash('success', 'The category has been deleted successfully.');
    return redirect()->route('admin.categories');
}
}
