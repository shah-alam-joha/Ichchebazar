<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use File;
use Image;

class SlidersController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth:admin');
 }
 public function index()
 {
    $sliders = Slider::orderBy('priority', 'asc')->get();
    return view('backend.pages.slider.index', compact('sliders'));

}

public function store(Request $request)
{
    $this->validate( $request,[
        'title' => 'required',
        'image' => 'required|image',
        'priority' => 'required|numeric',
        'button_link' => 'nullable|url',
    ],
    [
      'title.required' => 'Please provide a valid Slider title',
      'image.required' => 'Please provide a Slider image',
      'image.image' => 'Please provide a valid Slider image',
      'priority.required' => 'Please provide this slider priority',  
      'button_link.url' => 'Please provide a valid slider url',  
  ]);

    $slider = new Slider();
    $slider->title = $request->title;
    $slider->priority = $request->priority;
    $slider->button_link = $request->button_link;
    $slider->button_text = $request->button_text;

    if ($request->hasFile('image') > 0) {
        $image = $request->file('image');
        $img = time(). '.'.$image->getClientOriginalExtension();
        $location = 'images/sliders/'.$img;
        Image::make($image)->save($location);
        $slider->image = $img;
    }
    $slider->save();

    session()->flash('success', ' A new slider has been added successfully');
    return redirect()->route('admin.sliders');
}

public function update(Request $request, $id)
{
    $this->validate( $request, [
        'title' => 'required',
        'image' => 'nullable|image',
        'priority' => 'required|numeric',
        'button_link' => 'nullable|url',
    ],
    [
      'title.required' => 'Please provide a valid Slider title',
      'image.required' => 'Please provide a Slider image',
      'image.image' => 'Please provide a valid Slider image',
      'priority.required' => 'Please provide this slider priority',  
      'button_link.url' => 'Please provide a valid slider url',  
  ]);

    $slider = Slider::find($id);
    $slider->title = $request->title;
    $slider->priority = $request->priority;
    $slider->button_link = $request->button_link;
    $slider->button_text = $request->button_text;

    if (!is_null($request->image )) {
            //delete old image
        if (File::exists('images/sliders/'.$slider->image)) {
            File::delete('images/sliders/'.$slider->image);
        }
             //insert new image to this slider
        $image = $request->file('image');
        $img = time(). '.'.$image->getClientOriginalExtension();
        $location = 'images/sliders/'.$img;
        Image::make($image)->save($location);
        $slider->image = $img;


    }
    $slider->save();

    session()->flash('success', 'Slider has been updated successfully');
    return redirect()->route('admin.sliders');
}

public function delete($id)
{
    $slider = Slider::find($id);
    if (!is_null($slider)) {
        if (File::exists('images/sliders/'.$slider->image)) {
            File::delete('images/sliders/'.$slider->image);      
        }
        $slider->delete();
    }
    session()->flash('success', 'Slider has been deleted successfully');
    return redirect()->route('admin.sliders');
}
}
