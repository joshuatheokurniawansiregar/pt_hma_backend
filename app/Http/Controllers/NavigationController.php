<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    //
    function get_all_navigations(){
        return response()->json(['data'=> Navigation::all()]);
    }
}
