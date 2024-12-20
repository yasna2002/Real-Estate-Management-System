<?php

namespace App\Http\Controllers;

use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $properties = Property::paginate(15);
        return view('dashboard', compact('properties'));
    }
}
