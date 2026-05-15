@extends('layouts.app')

@section('title', 'Detalhes do Barbeiro')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-user-tie"></i>
                    Detalhes do barbeiro
                </h2>
                <p class="descricao-pagina">Informacoes de acesso e contato do profissional.</p>
            </div>

            <a href="{{ route('barbeiros.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-id-badge"></i>
                        {{ $barbeiro->name }}
                    </h3>
                    <div class="painel-subtitulo">{{ $barbeiro->email }}</div>
                </div>
                <span class="selo-contador">Barbeiro</span>
            </div>

            <div class="p-4 p-md-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">E-mail</div>
                        <div class="fw-bold">{{ $barbeiro->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Telefone</div>
                        <div class="fw-bold">{{ $barbeiro->telefone ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Perfil</div>
                        <div class="fw-bold">{{ ucfirst($barbeiro->cargo) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
