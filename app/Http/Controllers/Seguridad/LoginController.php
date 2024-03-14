<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seguridad\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            $usuario = Auth::user();
            $rol = $this->verificarUsuarioRol($usuario, $request);
            if ($rol) {
                $this->setSession($rol,$request);
            } else {
                return back()->withErrors(['email' => 'El usuario no tiene roles activos.',])->onlyInput('email');
            }
            return redirect()->intended('dashboard');
        }
        return back()->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',])->onlyInput('email');
    }

    //****************************************************************************************** */
    public function verificarUsuarioRol($usuario, $request){
        $rol = $usuario->rol()->where('estado',true)->first();
        if (!$rol) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return false;
        }
        return $rol;
    }

    //*********************************************************************************************** */
    public function setSession($rol,$request):void{
        $request->session()->put([
            'rol_id'=>$rol->id,
            'rol_nombre'=>$rol->nombre,
            'rol_slug'=>$rol->slug,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard()
    {
        return view('intranet.dashboard.index');
    }
    public function home()
    {
        return view('extranet.login.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
