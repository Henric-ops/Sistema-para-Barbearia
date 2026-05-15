@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-users"></i>
                    Clientes
                </h2>
                <p class="descricao-pagina">Gerencie os cadastros e contatos dos clientes.</p>
            </div>

            <a href="{{ route('clientes.create') }}" class="btn botao-primario">
                <i class="fas fa-plus"></i>
                Novo cliente
            </a>
        </div>

        <form method="GET" class="barra-filtros">
            <div class="input-group campo-busca">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou telefone" class="form-control">
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
                        <i class="fas fa-address-book"></i>
                        Lista de clientes
                    </h3>
                    <div class="painel-subtitulo">Dados essenciais para contato e identificacao.</div>
                </div>
                <span class="selo-contador">{{ $clientes->count() }}</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th class="text-end">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td><strong>{{ $cliente->nome }}</strong></td>
                                <td class="texto-secundario">{{ $cliente->telefone }}</td>
                                <td class="texto-secundario">{{ $cliente->cpf }}</td>
                                <td class="texto-secundario">{{ $cliente->email ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="botao-icone" data-bs-toggle="tooltip" data-bs-title="Editar cliente" aria-label="Editar cliente">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="botao-icone perigo" data-confirmacao="Tem certeza que deseja excluir este cliente?" data-bs-toggle="tooltip" data-bs-title="Excluir cliente" aria-label="Excluir cliente">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="estado-vazio">
                                        <i class="fas fa-users"></i>
                                        <p class="mb-0">Nenhum cliente encontrado.</p>
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
