<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('backoffice.property.index', compact('properties'));
    }


    public function create()
    {
        return view('backoffice.property.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->getValidation());
        $validatedData['user_id'] = $request->user()->id;
        try {
            Property::create($validatedData);
        }catch (\Exception $exception){
            return redirect()->route('backoffice.property.index')->with('error', $exception->getMessage());
        }
        return redirect()->route('backoffice.properties.index');
    }


    public function edit(string $id)
    {
        $property = Property::findOrfail($id);
        return view('backoffice.property.edit', compact('property'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        Property::destroy($id);
        return redirect()->back()->with('success', 'Deleted Successfully');
    }

    public function getValidation()
    {
        return [
            'type' => [
                'required',
                'string',
                Rule::in(Property::getPropetyTypes()),
            ],
            'status' => [
                'required',
                'string',
                Rule::in(Property::getPropertyStatus()),
            ],
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'location' => 'nullable|string',
            'city' => 'required|string|max:255',
            'size' => 'nullable|numeric',
            'rooms' => 'nullable|integer',
        ];
    }
}
