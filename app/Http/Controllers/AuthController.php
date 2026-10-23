<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de inicio de sesión.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Procesar el inicio de sesión con límite de intentos.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $key = Str::transliterate(
            Str::lower($request->input('email'))
            . '|'
            . $request->ip()
        );

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => "Demasiados intentos. Prueba de nuevo en {$seconds} segundos.",
            ]);
        }

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key);

            $request->session()->regenerate();

            return redirect()->intended(
                route('admin.pizzas.index')
            );
        }

        RateLimiter::hit($key, 60);

        throw ValidationException::withMessages([
            'email' => 'El correo o la contraseña no son correctos.',
        ]);
    }

    /**
     * Cerrar la sesión.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
