<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\BarbeiroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RelatorioAgendamentosController;
use App\Http\Controllers\RelatorioServicosController;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\User;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/relatorio/agendamentos/pdf', [RelatorioController::class, 'agendamentosPdf'])->name('relatorio.agendamentos.pdf');
Route::get('/relatorio/servicos/pdf', [RelatorioController::class, 'servicosPdf'])->name('relatorio.servicos.pdf');

Route::middleware('auth')->group(function () {
    // Dashboard do administrador (protegido)
    Route::middleware('only.admin')->group(function () {
        Route::get('dashboard', function () {
            $hoje = now()->startOfDay();
            $mesAtual = now()->startOfMonth();

            $data = [
                'clientesCount' => Cliente::count(),
                'servicosCount' => Servico::count(),
                'agendamentosCount' => Agendamento::count(),
                'barbeirosCount' => User::where('cargo', 'barbeiro')->count(),
                'pendentesCount' => Agendamento::where('status', 'agendado')->count(),
                'faturamentoMes' => Agendamento::with('servico')
                    ->where('status', 'concluido')
                    ->where('data_hora_inicio', '>=', $mesAtual)
                    ->get()
                    ->sum(fn($a) => $a->servico->preco ?? 0),
                'agendamentosHoje' => Agendamento::with('cliente', 'servico', 'barbeiro')
                    ->whereDate('data_hora_inicio', $hoje)
                    ->orderBy('data_hora_inicio')
                    ->get(),
            ];

            return view('dashboard', $data);
        })->name('dashboard');

        Route::get('/relatorio/agendamentos', [RelatorioAgendamentosController::class, 'relatorioAgendamentos'])->name('relatorio.agendamentos');
        Route::get('/relatorio/servicos', [RelatorioServicosController::class, 'relatorioServicos'])->name('relatorio.servicos');

        Route::get('/relatorios', function () {
            return view('relatorios.index');
        })->name('relatorios.index');
    });

    // Dashboard do barbeiro (protegido)
    Route::middleware('only.barbeiro')->group(function () {
        Route::get('barbeiro/dashboard', function () {
            $user = auth()->user();
            $hoje = now()->startOfDay();

            $data = [
                'agendamentosCount' => $user->agendamentos()->count(),
                'concluidosCount' => $user->agendamentos()->where('status', 'concluido')->count(),
                'canceladosCount' => $user->agendamentos()->where('status', 'cancelado')->count(),
                'agendamentosHoje' => $user->agendamentos()
                    ->with('cliente', 'servico')
                    ->whereDate('data_hora_inicio', $hoje)
                    ->orderBy('data_hora_inicio')
                    ->get(),
                'proximosAgendamentos' => $user->agendamentos()
                    ->with('cliente', 'servico')
                    ->where('data_hora_inicio', '>', now())
                    ->orderBy('data_hora_inicio')
                    ->take(5)
                    ->get(),
                'proximoCliente' => $user->agendamentos()
                    ->with('cliente', 'servico')
                    ->where('data_hora_inicio', '>', now())
                    ->where('status', 'agendado')
                    ->orderBy('data_hora_inicio')
                    ->first(),
            ];

            return view('barbeiro.dashboard', $data);
        })->name('barbeiro.dashboard');

        Route::get('barbeiro/agendamentos', function () {
            $agendamentos = auth()->user()->agendamentos()
                ->with('cliente', 'servico')
                ->orderBy('data_hora_inicio', 'desc')
                ->get();
            return view('barbeiro.agendamentos', compact('agendamentos'));
        })->name('barbeiro.agendamentos');
    });

    // Rotas disponíveis para todos (mas dados filtrados por cargo)
    Route::resource('clientes', ClienteController::class);
    Route::resource('servicos', ServicoController::class);
    Route::resource('barbeiros', BarbeiroController::class);
    Route::resource('agendamentos', AgendamentoController::class);


});