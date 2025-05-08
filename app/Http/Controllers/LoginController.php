<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Para consultas raw
use App\Models\User; // Asumiendo que usas el modelo User
use Illuminate\Support\Facades\Hash; // Para la comparación en modo seguro si no usas Auth::attempt

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_demo'); // Crearemos esta vista
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $isSecureMode = $request->has('secure_mode');

        if ($isSecureMode) {
            // MODO SEGURO: Usando Auth::attempt() de Laravel
            // Auth::attempt se encarga de hashear la contraseña proporcionada y compararla
            // con la contraseña hasheada en la base de datos. También previene SQL Injection.
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.demo'));
            }

            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros (Modo Seguro).',
            ])->onlyInput('email');

        } else {
            // MODO INSEGURO: Construyendo una consulta SQL raw (VULNERABLE)
            $email = $request->input('email');
            $password = $request->input('password'); 

            // ¡¡¡ADVERTENCIA: ESTO ES DELIBERADAMENTE VULNERABLE A INYECCIÓN SQL!!!
            // No uses esto en producción NUNCA.
            // El atacante podría inyectar algo como:
            // Email: admin@example.com' OR '1'='1
            // Password: (cualquier cosa, o también ' OR '1'='1)
            //
            // NOTA: Esta consulta es un ejemplo. La vulnerabilidad exacta y cómo explotarla
            // dependerá de la estructura de la consulta. Aquí, si el atacante conoce un email válido,
            // y la contraseña no se verifica de forma segura o se puede bypasear, podría entrar.
            // Una inyección común es: ' OR 1=1 --
            // La consulta se volvería: SELECT * FROM users WHERE email = 'user@example.com' OR 1=1 -- ' AND password = '...'
            // El -- comenta el resto de la línea, incluyendo la comprobación de contraseña si estuviera en la misma query.

            // Para este ejemplo, vamos a simular que la contraseña también se verifica en la query raw,
            // pero de una manera que podría ser bypaseada.
            // En una app real con passwords hasheadas, esta query directa NUNCA funcionaría para el password
            // a menos que se compare contra un hash (lo cual no se hace aquí para simplificar la vulnerabilidad).
            // Por lo tanto, la inyección se centrará más en el campo email.

            // Consulta vulnerable (ejemplo simple)
            // El $password no se está usando directamente para comparar un hash,
            // se está asumiendo que se podría inyectar algo para bypassar el chequeo de email,
            // y luego si el password del usuario encontrado (si existe) es 'password', funcionaría.
            // O, más realisticamente para un bypass:
            $rawQuery = "SELECT * FROM users WHERE email = '" . $email . "'";
            // Si el password también fuera parte de la consulta de forma vulnerable:
            // $rawQuery = "SELECT * FROM users WHERE email = '" . $email . "' AND password_plain = '" . $password . "'";
            // Pero como las contraseñas están hasheadas, esto es más difícil de demostrar sin cambiar el esquema.

            // La inyección más simple para bypass de login es hacer que la cláusula WHERE sea verdadera.
            // Ejemplo: email = 'admin@example.com' OR '1'='1' -- '
            // Password sería ignorado por el comentario SQL.

            // Vamos a hacer una consulta vulnerable donde se pueda inyectar en el email:
            try {
                // DB::select es más seguro por defecto, así que forzamos DB::raw para la demostración de vulnerabilidad
                // OJO: incluso con DB::raw, si usas bindings ('SELECT * FROM users where email = ?', [$email]),
                // Laravel te protege. La vulnerabilidad viene de concatenar strings.
                $query = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
                $users = DB::select(DB::raw($query)); // ¡Vulnerable!

                if (count($users) > 0) {
                    $user = User::find($users[0]->id); // Obtenemos el modelo completo para poder usar Auth::login

                    // En un escenario real vulnerable, el atacante podría haber bypaseado la comprobación de contraseña.
                    // Aquí, si la inyección SQL devuelve un usuario, intentamos loguearlo.
                    // Si el password también fuera vulnerable y se compara en la misma query,
                    // una inyección como ` ' OR '1'='1 ` en ambos campos podría funcionar.
                    // Para este demo, si la SQLi en email devuelve UN usuario, lo logueamos
                    // sin verificar la contraseña (simulando un bypass completo).

                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->intended(route('dashboard.demo'));
                }
            } catch (\Illuminate\Database\QueryException $e) {
                // Si la inyección SQL rompe la consulta, podría lanzar una excepción.
                return back()->withErrors([
                    'email' => 'Error en la consulta (Modo Inseguro). Detalle: ' . $e->getMessage(),
                ])->onlyInput('email');
            }


            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros (Modo Inseguro).',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login.demo.form'));
    }
}