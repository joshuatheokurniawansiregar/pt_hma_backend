<?php

namespace App\Http\Controllers;

use App\Models\WebsiteLogo;
use Illuminate\Http\Request;

class WebsiteLogoController extends Controller
{
    //
    public function get_website_logo_by_name(Request $request){
        $websiteLogo = WebsiteLogo::where('logo_file_name', $request->get('logo_file_name'))->first();
        return response()->json([
            "messages"=>[
                "error"=> false,
            ],
            "data" => $websiteLogo
        ], 200);
    }
}
