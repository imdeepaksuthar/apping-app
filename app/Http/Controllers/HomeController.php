<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve the user's role
        $role = Auth::user()->role->name;
        // Redirect based on the role
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'user') {
            return redirect()->route('user.dashboard');
        }

        return Redirect::back();

    }
}
