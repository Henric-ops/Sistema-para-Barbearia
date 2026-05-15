@extends('layouts.app')

@section('title', 'Detalhes do Cliente')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-user"></i>
                    Detalhes do cliente
                </h2>
                <p class="descricao-pagina">Informacoes cadastrais e contato.</p>
            </div>

            <a href="{{ route('clientes.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-address-card"></i>
                        {{ $cliente->nome }}
                    </h3>
                    <div class="painel-subtitulo">{{ $cliente->email ?? 'Sem e-mail cadastrado' }}</div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Telefone</div>
                        <div class="fw-bold">{{ $cliente->telefone }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">CPF</div>
                        <div class="fw-bold">{{ $cliente->cpf }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">E-mail</div>
                        <div>{{ $cliente->email ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Endereco</div>
                        <div>{{ $cliente->endereco ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
