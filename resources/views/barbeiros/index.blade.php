@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <div class="container-fluid py-4">

        <!-- ALERT -->
        @if(session('success'))
            <div class="alert alert-success fade-in mb-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div
            class="page-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">

            <div class="slide-in-left">
                <h2 class="page-title d-flex align-items-center gap-2">
                    <span class="icon-box">
                        <i class="fas fa-user-tie"></i>
                    </span>
                    Barbeiros
                </h2>

                <p class="page-description">
                    Gerencie os barbeiros da barbearia
                </p>
            </div>

            @if(auth()->user()->isAdministrador())
                <a href="{{ route('barbeiros.create') }}" class="btn btn-gold btn-md">
                    <i class="fas fa-plus"></i> Novo Barbeiro
                </a>
            @endif
        </div>

        <!-- BUSCA -->
        <form method="GET" class="mb-4 fade-in delay-200">
            <div class="input-group custom-search">

                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>

                <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou e-mail"
                    class="form-control">

                <button class="btn btn-gold px-4" type="submit">
                    Buscar
                </button>

            </div>
        </form>

        <!-- TABELA -->
        <div class="card custom-card">

            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list"></i> Lista de Barbeiros</span>

                <span class="badge badge-gold">
                    {{ $barbeiros->total() }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle custom-table">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($barbeiros as $barbeiro)
                            <tr>
                                <td>{{ $barbeiro->name }}</td>
                                <td>{{ $barbeiro->email }}</td>
                                <td>{{ $barbeiro->telefone ?? '-' }}</td>

                                <td class="text-end">
                                    <div class="table-actions">

                                        <a href="{{ route('barbeiros.edit', $barbeiro) }}"
                                            class="btn btn-table-action btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        @if(auth()->user()->isAdministrador())
                                            <form action="{{ route('barbeiros.destroy', $barbeiro) }}" method="POST"
                                                onsubmit="return confirm('Tem certeza?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-table-action btn-danger" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    Nenhum barbeiro encontrado
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- PAGINAÇÃO -->
            @if($barbeiros->hasPages())
                <div class="p-4 border-top">
                    {{ $barbeiros->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection