@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="conteudo-pagina">
        <div class="grade-indicadores">
            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador"><i class="fas fa-calendar-check"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $agendamentosCount }}</div>
                    <div class="rotulo-indicador">Agendamentos totais</div>
                </div>
            </div>

            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador verde"><i class="fas fa-users"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $clientesCount }}</div>
                    <div class="rotulo-indicador">Clientes cadastrados</div>
                </div>
            </div>

            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador azul"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">R$ {{ number_format($faturamentoMes, 2, ',', '.') }}</div>
                    <div class="rotulo-indicador">Faturamento do mes</div>
                </div>
            </div>

            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador vermelho"><i class="fas fa-clock"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $pendentesCount }}</div>
                    <div class="rotulo-indicador">Agendados em aberto</div>
                </div>
            </div>
        </div>



        <div class="painel">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-calendar-day"></i>
                        Agenda de hoje
                    </h3>
                    <div class="painel-subtitulo">{{ now()->format('d/m/Y') }}</div>
                </div>
                <span class="selo-contador">
                    <i class="fas fa-list-check"></i>
                    {{ $agendamentosHoje->count() }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Horario</th>
                            <th>Cliente</th>
                            <th>Barbeiro</th>
                            <th>Servico</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendamentosHoje as $agendamento)
                            <tr>
                                <td>
                                    <span class="texto-horario">
                                        {{ $agendamento->data_hora_inicio->format('H:i') }}
                                        - {{ $agendamento->data_hora_fim->format('H:i') }}
                                    </span>
                                </td>
                                <td><strong>{{ $agendamento->cliente->nome }}</strong></td>
                                <td class="texto-secundario">{{ $agendamento->barbeiro->name }}</td>
                                <td>
                                    <span class="selo-servico">
                                        <i class="fas fa-scissors"></i>
                                        {{ $agendamento->servico->nome }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-agendamento {{ $agendamento->status }}">
                                        {{ ucfirst($agendamento->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="estado-vazio">
                                        <i class="fas fa-calendar-times"></i>
                                        <p class="mb-0">Nenhum agendamento para hoje.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
