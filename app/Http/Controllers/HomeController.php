<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Concesionario;

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
        $concesionarios = Concesionario::all();
        return view('home', compact('concesionarios'));
    }
}
