@extends('layouts.app')

@section('title', 'Agenda')

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
                    Agenda
                </h2>
                <p class="descricao-pagina">
                    Acompanhe horarios, barbeiros, servicos e status dos atendimentos.
                </p>
            </div>

            @if(auth()->user()->isAdministrador())
                <a href="{{ route('agendamentos.create') }}" class="btn botao-primario">
                    <i class="fas fa-plus"></i>
                    Novo agendamento
                </a>
            @endif
        </div>

        <form method="GET" class="barra-filtros">
            <div class="input-group campo-busca">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar por cliente ou barbeiro"
                    class="form-control"
                >
            </div>
            <button class="btn botao-secundario" type="submit">
                <i class="fas fa-filter"></i>
                Filtrar
            </button>
        </form>

        <div class="painel">

            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-list-check"></i>
                        Agendamentos
                    </h3>
                    <div class="painel-subtitulo">
                        Lista geral filtrada conforme seu perfil de acesso.
                    </div>
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
                            <th>Barbeiro</th>
                            <th>Serviço</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($agendamentos as $agendamento)
                            <tr>
                                <td>
                                    <strong>{{ $agendamento->cliente->nome }}</strong>
                                </td>
                                <td class="texto-secundario">{{ $agendamento->barbeiro->name }}</td>

                                <td>
                                    <span class="selo-servico">
                                        <i class="fas fa-scissors"></i>
                                        {{ $agendamento->servico->nome }}
                                    </span>
                                </td>

                                <td>
                                    <span class="texto-horario">
                                        {{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="texto-horario">
                                        {{ $agendamento->data_hora_fim->format('d/m/Y H:i') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="status-agendamento {{ $agendamento->status }}">
                                        {{ ucfirst($agendamento->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                    @if(auth()->user()->isAdministrador() || auth()->id() === $agendamento->barbeiro_id)
                                        <a href="{{ route('agendamentos.edit', $agendamento) }}"
                                            class="botao-icone"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Editar agendamento"
                                            aria-label="Editar agendamento">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(auth()->user()->isAdministrador())
                                        <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="botao-icone perigo"
                                                type="submit"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Excluir agendamento"
                                                data-confirmacao="Tem certeza que deseja excluir este agendamento?"
                                                aria-label="Excluir agendamento">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
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
