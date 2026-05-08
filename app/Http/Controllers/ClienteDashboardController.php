<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;

class ClienteDashboardController extends Controller
{
    public function __invoke()
    {
        $cliente = Auth::user()->cliente;

        abort_unless($cliente, 404, 'Perfil de cliente nao encontrado.');

        $agendamentos = Agendamento::with('barbeiro', 'servico')
            ->where('cliente_id', $cliente->id)
            ->orderBy('data_hora_inicio', 'desc')
            ->get();

        return view('cliente.dashboard', [
            'cliente' => $cliente,
            'agendamentos' => $agendamentos,
        ]);
    }
}
