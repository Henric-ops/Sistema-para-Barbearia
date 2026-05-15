@extends('layouts.app')

@section('title', 'Barbeiros')

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
                    <i class="fas fa-user-tie"></i>
                    Barbeiros
                </h2>
                <p class="descricao-pagina">Gerencie equipe, contatos e acessos dos barbeiros.</p>
            </div>

            @if(auth()->user()->isAdministrador())
                <a href="{{ route('barbeiros.create') }}" class="btn botao-primario">
                    <i class="fas fa-plus"></i>
                    Novo barbeiro
                </a>
            @endif
        </div>

        <form method="GET" class="barra-filtros">
            <div class="input-group campo-busca">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou e-mail" class="form-control">
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
                        <i class="fas fa-list"></i>
                        Lista de barbeiros
                    </h3>
                    <div class="painel-subtitulo">Profissionais cadastrados no sistema.</div>
                </div>
                <span class="selo-contador">{{ $barbeiros->total() }}</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th class="text-end">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barbeiros as $barbeiro)
                            <tr>
                                <td><strong>{{ $barbeiro->name }}</strong></td>
                                <td class="texto-secundario">{{ $barbeiro->email }}</td>
                                <td class="texto-secundario">{{ $barbeiro->telefone ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('barbeiros.edit', $barbeiro) }}" class="botao-icone" data-bs-toggle="tooltip" data-bs-title="Editar barbeiro" aria-label="Editar barbeiro">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        @if(auth()->user()->isAdministrador())
                                            <form action="{{ route('barbeiros.destroy', $barbeiro) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="botao-icone perigo" data-confirmacao="Tem certeza que deseja excluir este barbeiro?" data-bs-toggle="tooltip" data-bs-title="Excluir barbeiro" aria-label="Excluir barbeiro">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="estado-vazio">
                                        <i class="fas fa-user-tie"></i>
                                        <p class="mb-0">Nenhum barbeiro encontrado.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($barbeiros->hasPages())
                <div class="p-4 border-top border-secondary border-opacity-25">
                    {{ $barbeiros->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
