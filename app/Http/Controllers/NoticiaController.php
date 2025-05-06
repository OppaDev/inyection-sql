<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        return view('n.index');
    }

    function guardar(Request $request)
    {
        $noticia = new Noticia();
        $noticia->contenido = $request-> contenido;
        $noticia->save();
        return redirect()-> route('n.index');
    }
}
