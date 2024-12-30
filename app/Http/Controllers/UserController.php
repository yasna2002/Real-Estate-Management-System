<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Image;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backoffice.user.index', compact('users'));
    }



    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->back()->with('message', 'Deleted Successfully');
    }

}
