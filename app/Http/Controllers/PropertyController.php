<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

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
            $property = Property::create($validatedData);
            if ($request->photo){
                $filename = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('images'), $filename);
                Image::create([
                    'property_id' => $property->id,
                    'image_url' => $filename,
                ]);
            };
        }catch (\Exception $exception){
            dd($exception->getMessage());
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
        $property = Property::findOrfail($id);
        $validatedData = $request->validate($this->getValidation());
        try {
            $property->update($validatedData);
            if ($request->photo){
                $image_path = public_path('images/' . $property?->image?->image_url);

                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $filename = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('images'), $filename);
                $property->image->update([
                    'image_url' => $filename,
                ]);
            };
        }catch (\Exception $exception){
            dd($exception->getMessage());
            return redirect()->route('backoffice.property.index')->with('error', $exception->getMessage());
        }
        return redirect()->route('backoffice.properties.index');
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
            'photo' => 'nullable|extensions:jpg,jpeg,png',
        ];
    }
}
