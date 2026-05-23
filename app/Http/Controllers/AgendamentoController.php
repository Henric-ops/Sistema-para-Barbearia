<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\User;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Agendamento::with('cliente', 'servico', 'barbeiro');
        $dataSelecionada = Carbon::parse($request->input('data', now()->toDateString()))->startOfDay();
        $barbeiroSelecionado = $request->input('barbeiro_id');

        if (Auth::user()->isBarbeiro()) {
            $query->where('barbeiro_id', Auth::id());
            $barbeiroSelecionado = Auth::id();
        }

        if (Auth::user()->isCliente()) {
            $cliente = Auth::user()->cliente;
            abort_unless($cliente, 404, 'Perfil de cliente nao encontrado.');
            $query->where('cliente_id', $cliente->id);
        }

        if ($barbeiroSelecionado && Auth::user()->isAdministrador()) {
            $query->where('barbeiro_id', $barbeiroSelecionado);
        }

        $query->whereDate('data_hora_inicio', $dataSelecionada);

        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function ($query) use ($term) {
                $query->whereHas('cliente', fn ($q) => $q->where('nome', 'like', $term))
                    ->orWhereHas('barbeiro', fn ($q) => $q->where('name', 'like', $term));
            });
        }

        $agendamentos = $query
            ->orderBy('data_hora_inicio')
            ->get();

        $barbeirosFiltro = User::where('cargo', 'barbeiro')->orderBy('name')->get();

        $barbeiros = Auth::user()->isBarbeiro()
            ? collect([Auth::user()])
            : $barbeirosFiltro;

        if (Auth::user()->isCliente()) {
            $barbeiros = $agendamentos
                ->pluck('barbeiro')
                ->filter()
                ->unique('id')
                ->values();
        }

        if ($barbeiroSelecionado && ! Auth::user()->isBarbeiro()) {
            $barbeiros = $barbeiros->where('id', (int) $barbeiroSelecionado)->values();
        }

        return view('agendamentos.index', [
            'agendamentos' => $agendamentos,
            'agendamentosPorBarbeiro' => $agendamentos->groupBy('barbeiro_id'),
            'barbeiros' => $barbeiros,
            'barbeirosFiltro' => $barbeirosFiltro,
            'dataSelecionada' => $dataSelecionada,
            'dataAnterior' => $dataSelecionada->copy()->subDay(),
            'dataProxima' => $dataSelecionada->copy()->addDay(),
            'barbeiroSelecionado' => $barbeiroSelecionado,
        ]);
    }

    public function create()
    {
        abort_unless(Auth::user()->isAdministrador(), 403);

        $clientes = Cliente::all();
        $servicos = Servico::all();
        $barbeiros = User::where('cargo', 'barbeiro')->get();
        return view('agendamentos.create', compact('clientes', 'servicos', 'barbeiros'));
    }

    public function store(StoreAgendamentoRequest $request)
    {
        abort_unless(Auth::user()->isAdministrador(), 403);

        Agendamento::create($request->validated());
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso.');
    }

    public function show(Agendamento $agendamento)
    {
        abort_unless(
            Auth::user()->isAdministrador()
                || Auth::id() === $agendamento->barbeiro_id
                || Auth::user()->cliente?->id === $agendamento->cliente_id,
            403
        );

        $agendamento->load('cliente', 'servico', 'barbeiro');
        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        abort_if(Auth::user()->isCliente(), 403);

        if (Auth::user()->isAdministrador()) {
            // Admin acessa todos os agendamentos para editar tudo
            $clientes = Cliente::all();
            $servicos = Servico::all();
            $barbeiros = User::where('cargo', 'barbeiro')->get();
            return view('agendamentos.edit', compact('agendamento', 'clientes', 'servicos', 'barbeiros'));
        } else {
            // Barbeiro só pode editar seu próprio agendamento (apenas status)
            abort_unless(Auth::id() === $agendamento->barbeiro_id, 403);
            return view('agendamentos.edit', compact('agendamento'));
        }
    }

    public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
    {
        abort_if(Auth::user()->isCliente(), 403);

        // Admin atualiza qualquer coisa
        if (Auth::user()->isAdministrador()) {
            $agendamento->update($request->validated());
            return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso.');
        }

        // Barbeiro só pode atualizar status do seu próprio agendamento
        abort_unless(Auth::id() === $agendamento->barbeiro_id, 403);
        
        $validated = $request->validate([
            'status' => 'required|in:agendado,concluido,cancelado',
        ]);

        $agendamento->update($validated);
        return redirect()->route('agendamentos.index')->with('success', 'Status do agendamento atualizado.');
    }

    public function destroy(Agendamento $agendamento)
    {
        abort_unless(Auth::user()->isAdministrador(), 403);

        $agendamento->delete();
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento deletado com sucesso.');
    }
}
