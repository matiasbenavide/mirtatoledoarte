<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function welcome(Request $request)
    {
        $isAdmin = false;

        if($request->user()->role_as && $request->user()->role_as == 1)
        {
            $isAdmin = true;
        }

        return view('welcome')->with([
            'isAdmin' => $isAdmin
        ]);
    }
}
