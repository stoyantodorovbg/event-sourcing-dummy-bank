<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function home(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('home.home');
    }
}
