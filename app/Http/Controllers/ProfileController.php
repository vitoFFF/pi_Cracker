<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // Retrieve authenticated user
        $user = auth()->user();
        
        // Pass user data to the profile view
        return view('user/profile', compact('user'));
    }
}
