<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ProductsRepository;
use App\Repositories\Admin\ParametersRepository;
use App\Http\Controllers\ProductClientController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
    )
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home(Request $request)
    {
        $isAdmin = false;

        if($request->user() && $request->user()->role_as && $request->user()->role_as == User::ID_USER_ADMIN)
        {
            $isAdmin = true;
        }

        return view('home')->with([
            'isAdmin' => $isAdmin,
        ]);
    }
}
