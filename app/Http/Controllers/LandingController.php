<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() 
    {
        $featureds = News::where('is_featured', true)->get();

        return view('pages.landing', compact('featureds'));
    }
}
