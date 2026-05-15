@extends('layouts.app')

@section('title', 'Servicos')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-scissors"></i>
                    Servicos
                </h2>
                <p class="descricao-pagina">Organize os servicos oferecidos pela barbearia.</p>
            </div>

            <a href="{{ route('servicos.create') }}" class="btn botao-primario">
                <i class="fas fa-plus"></i>
                Novo servico
            </a>
        </div>

        <form method="GET" class="barra-filtros">
            <div class="input-group campo-busca">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou descricao" class="form-control">
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
                        Lista de servicos
                    </h3>
                    <div class="painel-subtitulo">Preco, duracao e manutencao do catalogo.</div>
                </div>
                <span class="selo-contador">{{ $servicos->count() }}</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle tabela-sistema">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preco</th>
                            <th>Duracao</th>
                            <th class="text-end">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servicos as $servico)
                            <tr>
                                <td>
                                    <span class="selo-servico">
                                        <i class="fas fa-scissors"></i>
                                        {{ $servico->nome }}
                                    </span>
                                </td>
                                <td><strong>R$ {{ number_format($servico->preco, 2, ',', '.') }}</strong></td>
                                <td class="texto-secundario">{{ $servico->duracao_minutos }} min</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('servicos.edit', $servico) }}" class="botao-icone" data-bs-toggle="tooltip" data-bs-title="Editar servico" aria-label="Editar servico">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('servicos.destroy', $servico) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="botao-icone perigo" data-confirmacao="Tem certeza que deseja excluir este servico?" data-bs-toggle="tooltip" data-bs-title="Excluir servico" aria-label="Excluir servico">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="estado-vazio">
                                        <i class="fas fa-scissors"></i>
                                        <p class="mb-0">Nenhum servico encontrado.</p>
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
