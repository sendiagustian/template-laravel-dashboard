<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('login')->with(['success' => 'You have been logged out successfully.']);
    }
}
