<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'user') {
                return view('home.homepage');
            } else if ($usertype == 'admin') {
                return view('admin.adminhome');
            } else {
                // Remove the redirect()->back() here to stay on the same page
                return view('home.homepage'); // Or any default view you prefer
            }
        }
        
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login'); // Create this view
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->usertype === 'admin') {
                return redirect()->route('admin.index'); // Redirect to admin dashboard
            } else {
                Auth::logout(); // Logout if not admin
                return redirect()->route('admin.login.form')->withErrors(['message' => 'Unauthorized']);
            }
        }

        return redirect()->route('admin.login.form')->withErrors(['message' => 'Invalid credentials']);
    }


    public function homepage()
    {
        return view('home.homepage');
    }
}