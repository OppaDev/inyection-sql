<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    function index() {
        return view('users.index');
    }

    function store(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        // Consulta vulnerable a SQL Injection
        $sqlUser = DB::select("SELECT * FROM users WHERE email='$email' AND password='$password'");

        if ($sqlUser) {
            return response()->json($sqlUser);
        } else {
            return 'usuario no encontrado';
        }
    }
}
