<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class SpaController extends Controller
{

    /**
     * Loads Main View
     *
     * @return View
     */
    public function index()
    {
        return view('spa');
    }
}
