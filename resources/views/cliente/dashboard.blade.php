@extends('layouts.app')

@section('title', 'Meus Agendamentos')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check"></i>
                    Minha agenda
                </h2>
                <p class="descricao-pagina">
                    {{ $cliente->nome }}, acompanhe seus horarios e o historico de atendimentos.
                </p>
            </div>
        </div>

        <div class="destaque-operacional">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h3>Seus atendimentos</h3>
                    <p>{{ $agendamentos->count() }} agendamento(s) encontrados no seu cadastro.</p>
                </div>
                <span class="selo-contador align-self-start align-self-md-center">
                    <i class="fas fa-calendar-alt"></i>
                    {{ $agendamentos->count() }}
                </span>
            </div>
        </div>

        <div class="painel">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-list-check"></i>
                        Historico
                    </h3>
                    <div class="painel-subtitulo">Servicos, barbeiros, horarios e status.</div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Horario</th>
                            <th>Barbeiro</th>
                            <th>Servico</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendamentos as $agendamento)
                            <tr>
                                <td>{{ $agendamento->data_hora_inicio->format('d/m/Y') }}</td>
                                <td>
                                    <span class="texto-horario">
                                        {{ $agendamento->data_hora_inicio->format('H:i') }}
                                        - {{ $agendamento->data_hora_fim->format('H:i') }}
                                    </span>
                                </td>
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
