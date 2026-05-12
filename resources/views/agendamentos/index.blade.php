@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class="container-fluid py-4">

        @if(session('success'))
            <div class="alert d-flex align-items-center gap-2">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h2 class="page-title d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-alt"></i>
                    Agendamentos
                </h2>
                <p class="page-description">
                    Gerencie a agenda de clientes e barbeiros.
                </p>
            </div>

            @if(auth()->user()->isAdministrador())
                <a href="{{ route('agendamentos.create') }}" class="btn btn-gold">
                    <i class="fas fa-plus"></i> Novo
                </a>
            @endif
        </div>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar agendamentos..."
                    class="form-control">
                <button class="btn btn-gold px-4" type="submit">
                    Buscar
                </button>
            </div>
        </form>

        <div class="card agendamento-table">

            <div class="card-header-custom d-flex justify-content-between p-3">
                <span class="d-flex align-items-center gap-2">
                    <i class="fas fa-list"></i>
                    Lista de Agendamentos
                </span>
                <span class="badge badge-primary">
                    {{ $agendamentos->count() }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table agendamento-table align-middle">

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
                                    <strong class="cliente-nome">{{ $agendamento->cliente->nome }}</strong>
                                </td>
                                <td class="barbeiro-nome">{{ $agendamento->barbeiro->name }}</td>

                                <td>
                                    <span class="badge servico-badge">
                                        {{ $agendamento->servico->nome }}
                                    </span>
                                </td>

                                <td>
                                    <span class="datatime">
                                        {{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="datatime">
                                        {{ $agendamento->data_hora_fim->format('d/m/Y H:i') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="status-chip status-chip--{{ $agendamento->status }}">
                                        {{ ucfirst($agendamento->status) }}
                                    </span>
                                </td>

                                <td class="text-end d-flex gap-2 justify-content-end">
                                    @if(auth()->user()->isAdministrador() || auth()->id() === $agendamento->barbeiro_id)
                                        <a href="{{ route('agendamentos.edit', $agendamento) }}"
                                            class="btn btn-sm btn-table-action btn-outline-primary" title="Editar agendamento">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(auth()->user()->isAdministrador())
                                        <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-table-action btn-danger" title="Excluir agendamento"
                                                onclick="return confirm('Tem certeza que deseja excluir este agendamento?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted mb-0">Nenhum agendamento encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>
@endsection