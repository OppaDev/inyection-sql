<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    function index(){
        return view('cuentas.index');
    }

    function procesar(Request $request){
        $usuario=$request->input('usuario');
        
       //$cuentaSql= DB::select("SELECT * FROM cuentas WHERE usuario='$usuario'");

       $cuentaSql= Cuenta::where('usuario',$usuario)->first();
       
       return $cuentaSql;
    }
}
