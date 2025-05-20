<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $savedNews = $user->savedNews()->latest()->get();

        return view('user.profile', compact('user', 'savedNews'));
    }
}
