@extends('layouts.app')

@section('title', 'Detalhes do Servico')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-scissors"></i>
                    Detalhes do servico
                </h2>
                <p class="descricao-pagina">Informacoes usadas para precificacao e agenda.</p>
            </div>

            <a href="{{ route('servicos.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-scissors"></i>
                        {{ $servico->nome }}
                    </h3>
                    <div class="painel-subtitulo">{{ $servico->duracao_minutos }} minutos de duracao</div>
                </div>
                <span class="selo-contador">R$ {{ number_format($servico->preco, 2, ',', '.') }}</span>
            </div>

            <div class="p-4 p-md-5">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Descricao</div>
                        <div>{{ $servico->descricao ?: 'Sem descricao cadastrada.' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Preco</div>
                        <div class="fw-bold">R$ {{ number_format($servico->preco, 2, ',', '.') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Duracao</div>
                        <div class="fw-bold">{{ $servico->duracao_minutos }} minutos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
