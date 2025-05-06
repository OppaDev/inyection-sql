<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index(){
        return view('usuarios.index');
    }

    public function procesar(Request $request){
        
        $email=$request->input('email');
        $password=$request->input('password');

        
       // $sqlUser=DB::select("SELECT * FROM users where email = '$email' AND password='$password' ");


        //1.  query builder
       //$sqlUser= DB::table('users')->where('email',$email)->where('password',$password)->get();

       $sqlUser=Usuario::where('email',$email)
       ->where('password',$password)->get();

        if($sqlUser){
            return $sqlUser;
        }else{
            return 'NO EXISTE USUARIO CON ESA CREDENCIALES';
        }
    }
}
