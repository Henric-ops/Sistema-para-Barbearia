@extends('layouts.app')

@section('title', 'Meus Agendamentos')

@section('content')
    <div class="conteudo-pagina">
        @if(session('success'))
            <div class="alert alerta-sistema d-flex align-items-center gap-2 mb-0">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-alt"></i>
                    Meus agendamentos
                </h2>
                <p class="descricao-pagina">Consulte sua agenda e atualize o status dos atendimentos.</p>
            </div>
        </div>

        <div class="painel">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-list-check"></i>
                        Lista de atendimentos
                    </h3>
                    <div class="painel-subtitulo">Ordenada dos mais recentes para os mais antigos.</div>
                </div>
                <span class="selo-contador">
                    <i class="fas fa-calendar-check"></i>
                    {{ $agendamentos->count() }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Servico</th>
                            <th>Inicio</th>
                            <th>Fim</th>
                            <th>Status</th>
                            <th class="text-end">Acao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendamentos as $agendamento)
                            <tr>
                                <td><strong>{{ $agendamento->cliente->nome }}</strong></td>
                                <td>
                                    <span class="selo-servico">
                                        <i class="fas fa-scissors"></i>
                                        {{ $agendamento->servico->nome }}
                                    </span>
                                </td>
                                <td><span class="texto-horario">{{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }}</span></td>
                                <td><span class="texto-horario">{{ $agendamento->data_hora_fim->format('d/m/Y H:i') }}</span></td>
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
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="estado-vazio">
                                        <i class="fas fa-calendar-times"></i>
                                        <p class="mb-0">Nenhum agendamento encontrado.</p>
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
