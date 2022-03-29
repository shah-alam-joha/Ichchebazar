<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;

class DistrictsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function index()
    {
        $districts = District::orderBy('name', 'asc')->get();
        return view('backend.pages.district.index', compact('districts'));
        
    }
    public function create()
    {
        $divisions = Division::orderBy('priority_id', 'asc')->get();
        return view('backend.pages.district.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $this->validate( $request, [
            'name' => 'required',
            'division_id' => 'required',
        ],
        [
            'name.required' => 'Please provide a district Name',
            'division_id.required' => 'Please provide a Division Name',
        ]);

        $district = new District();
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();

        session()->flash('success', 'A new district has been added successfully');
        return redirect()->route('admin.districts');
    }

    public function edit($id)
    {
        $district = District::find($id);
         $divisions = Division::orderBy('priority_id', 'asc')->get();
        return view('backend.pages.district.edit', compact('district', 'divisions'));
    }
    public function update(Request $request, $id)
    {
        $this->validate( $request, [
            'name' => 'required',
            'division_id' => 'required',
        ],
        [
            'name.required' => 'Please provide a district Name',
            'division_id.required' => 'Please provide a Division Name',
        ]);
        $district = District::find($id);
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();

        session()->flash('success', 'A new district has been updated successfully');
        return redirect()->route('admin.districts');
    }
    public function delete($id)
    {
        $district = District::find($id);
        if (!is_null($district)) {
            $district->delete();
        }
        session()->flash('success', 'A new district has been deleted successfully');
        return redirect()->route('admin.districts');
    }
}
