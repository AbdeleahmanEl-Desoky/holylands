<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;


class PageController extends Controller
{

    public function index()
    {
        $page = Page::where('slug', 'about-application')->first();
        $settings = Setting::pluck('value','name');


        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => [
                'about' => $page,
                'social' => $settings,
            ]
        ]);
    }

    public function policy()
    {
        $page = Page::where('slug', 'policy')->first();

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $page
        ]);
    }


}
