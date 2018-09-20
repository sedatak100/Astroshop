<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\BackendController;

class HomeController extends BackendController
{
    public function index()
    {
        return redirect()->route('backend.product.lists');
        return view('backend.home.home');
    }
}
