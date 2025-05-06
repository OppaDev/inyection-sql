<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        return view('n.index');
    }

    function guardar(Request $request)
    {
        return $request;
    }
}
