<?php

namespace App\Http\Controllers;

use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $properties = Property::paginate(15);

        foreach ($properties as $property) {
            $property['likes'] = 0;
            $property['dislikes'] = 0;
            foreach ($property->favorites as $favorite) {
                if(!is_null($favorite->likes)) $property->likes++ ;
                if(!is_null($favorite->dislikes))$property->dislikes++;
            }
        }
        return view('dashboard', compact('properties'));
    }
}
