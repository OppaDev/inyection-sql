<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::get();

        return view('n.index', ['noticias' => $noticias]);
    }

    function guardar(Request $request)
    {
        $noticia = new Noticia();
        $noticia->contenido = $request-> contenido;
        $noticia->save();
        return redirect()-> route('n.index');
    }
}
