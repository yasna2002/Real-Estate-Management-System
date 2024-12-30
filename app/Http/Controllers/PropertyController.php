<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
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
            $this->handleImageUpload($request->photo, $property->id);
        } catch (\Exception $exception) {
            return $this->handleError($exception);
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
        $property = Property::findOrFail($id);
        $validatedData = $request->validate($this->getValidation());

        try {
            $property->update($validatedData);
            $this->handleImageUpload($request->photo, $property->id, $property->image);
        } catch (\Exception $exception) {
            return $this->handleError($exception);
        }

        return redirect()->route('backoffice.properties.index');
    }

    private function handleImageUpload($photo, $propertyId, $existingImage = null)
    {
        if ($photo) {
            if ($existingImage) {
                $imagePath = public_path('images/' . $existingImage->image_url);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images'), $filename);

            if ($existingImage) {
                $existingImage->update(['image_url' => $filename]);
            } else {
                Image::create(['property_id' => $propertyId, 'image_url' => $filename]);
            }
        }
    }

    private function handleError($exception)
    {
        return redirect()->route('backoffice.property.index')->with('error', $exception->getMessage());
    }

    public function destroy(string $id)
    {
        Property::destroy($id);
        return redirect()->back()->with('success', 'Deleted Successfully');
    }

    public function actionOnProperty($id, Request $request)
    {
        /** @var Property $property */
        $property = Property::findOrfail($id);
        $favorite = Favorite::where('property_id', $property->id)->where('user_id', $request->user()->id)->first();
        if ($request->dislike || $request->like) {
            if (!$favorite){
                Favorite::create([
                    'user_id' => $request->user()->id,
                    'property_id' => $property->id,
                    'dislikes' => $request->dislike,
                    'likes' => $request->like,
                ]);
            }elseif ($request->dislike){
                $favorite->update([
                    'dislikes' => 1,
                    'likes' => null,
                ]);
            }elseif ($request->like){
                $favorite->update([
                    'likes' => 1,
                    'dislikes' => null,
                ]);
            }
        }
       return redirect()->back();
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
