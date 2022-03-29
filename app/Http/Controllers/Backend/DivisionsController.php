<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;

class DivisionsController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth:admin');
    }
    public function index()
    {
        $divisions = Division::orderBy('priority_id', 'asc')->get();
        return view('backend.pages.division.index', compact('divisions'));
        
    }

    public function create()
    {
       return view('backend.pages.division.create');
    }
    public function store(Request $request)
    {
        $this->validate( $request,[
            'name' => 'required',
            'priority_id' => 'required|numeric',
        ],
        [
          'name.required' => 'Please provide a valid Division Name',
          'priority_id.required' => 'Please provide a numeric priority id',  
        ]);

        $division = new Division();
        $division->name = $request->name;
        $division->priority_id = $request->priority_id;
        $division->save();

        session()->flash('success', ' A new division has been added successfully');
        return redirect()->route('admin.divisions');
    }
    public function edit($id)
    {
        $division = Division::find($id);
        return view('backend.pages.division.edit',compact('division'));
    }

    public function update(Request $request, $id)
    {
        $this->validate( $request, [
            'name' => 'required',
            'priority_id' => 'required|numeric',
        ],
        [
            'name.required' => 'Please provide a valid Division Name',
            'priority_id.required' => 'Please provide a numeric priority id',
        ]);

        $division = Division::find($id);
        $division->name = $request->name;
        $division->priority_id = $request->priority_id;
        $division->save();

        session()->flash('success', 'division has been edited successfully');
        return redirect()->route('admin.divisions');
    }

    public function delete($id)
    {
        $division = Division::find($id);
        if (!is_null($division)) {
            // delete all districts of this division
            $districts = District::where('division_id', $division->id)->get();
            foreach ($districts as $district) {
                $district->delete();
            }
            $division->delete();
        }
        session()->flash('success', 'Division has been deleted successfully');
        return redirect()->route('admin.divisions');
    }
}
