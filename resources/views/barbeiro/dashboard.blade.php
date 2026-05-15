@extends('layouts.app')

@section('title', 'Meu Painel')

@section('content')
    <div class="conteudo-pagina">
        <div class="destaque-operacional">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div>
                    <h3>Olá, {{ explode(' ', auth()->user()->name)[0] }}</h3>
                    <p>
                        Você tem {{ $agendamentosHoje->count() }} atendimento(s) na agenda de hoje.
                    </p>
                </div>

                @if($proximoCliente)
                    <div class="d-flex align-items-center gap-3">
                        <span class="icone-indicador"><i class="fas fa-clock"></i></span>
                        <div>
                            <div class="texto-secundario small text-uppercase fw-bold">Proximo cliente</div>
                            <div class="fw-bold">
                                {{ $proximoCliente->cliente->nome }}
                                <span class="texto-horario ms-2">{{ $proximoCliente->data_hora_inicio->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="grade-indicadores">
            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador"><i class="fas fa-calendar-check"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $agendamentosCount }}</div>
                    <div class="rotulo-indicador">Total de agendamentos</div>
                </div>
            </div>

            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador verde"><i class="fas fa-circle-check"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $concluidosCount }}</div>
                    <div class="rotulo-indicador">Concluidos</div>
                </div>
            </div>

            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador vermelho"><i class="fas fa-circle-xmark"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $canceladosCount }}</div>
                    <div class="rotulo-indicador">Cancelados</div>
                </div>
            </div>

            <div class="cartao-indicador">
                <div class="cartao-indicador-topo">
                    <span class="icone-indicador azul"><i class="fas fa-calendar-day"></i></span>
                </div>
                <div>
                    <div class="valor-indicador">{{ $agendamentosHoje->count() }}</div>
                    <div class="rotulo-indicador">Hoje</div>
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
                    <div class="painel-subtitulo">Atendimentos previstos para este dia.</div>
                </div>
                <a href="{{ route('barbeiro.agendamentos') }}" class="btn botao-secundario">
                    <i class="fas fa-list"></i>
                    Ver todos
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Horario</th>
                            <th>Cliente</th>
                            <th>Servico</th>
                            <th>Status</th>
                            <th class="text-end">Acao</th>
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
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a
                                            href="{{ route('agendamentos.edit', $agendamento) }}"
                                            class="botao-icone"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Atualizar status"
                                            aria-label="Atualizar status"
                                        >
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="estado-vazio">
                                        <i class="fas fa-sun"></i>
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
