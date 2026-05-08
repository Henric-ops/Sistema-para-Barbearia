<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route($this->homeRouteFor(Auth::user()));
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redireciona com base no cargo do usuário
            $user = Auth::user();
            
            if ($user->isAdministrador()) {
                return redirect()->intended(route('dashboard'));
            } elseif ($user->isBarbeiro()) {
                return redirect()->intended(route('barbeiro.dashboard'));
            } elseif ($user->isCliente()) {
                return redirect()->intended(route('cliente.dashboard'));
            }
            
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas. Verifique seu e-mail e senha.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout realizado com sucesso.');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route($this->homeRouteFor(Auth::user()));
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:20', 'unique:clientes,cpf'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', 'unique:clientes,email'],
            'telefone' => ['required', 'string', 'max:20'],
            'endereco' => ['nullable', 'string', 'max:1000'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['nome'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'telefone' => $validated['telefone'],
                'cargo' => 'cliente',
            ]);

            Cliente::create([
                'user_id' => $user->id,
                'nome' => $validated['nome'],
                'cpf' => $validated['cpf'],
                'email' => $validated['email'],
                'telefone' => $validated['telefone'],
                'endereco' => $validated['endereco'] ?? null,
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('cliente.dashboard')
            ->with('success', 'Cadastro realizado com sucesso.');
    }

    private function homeRouteFor(User $user): string
    {
        if ($user->isAdministrador()) {
            return 'dashboard';
        }

        if ($user->isBarbeiro()) {
            return 'barbeiro.dashboard';
        }

        return 'cliente.dashboard';
    }
}
