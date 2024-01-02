<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $title = "Dashboard";
        $products = Product::all();
        $users = User::all();
        return view('pages.dashboard', compact([
            'title', 'products', 'users'
        ]));
    }
}
