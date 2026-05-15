@extends('layouts.app')

@section('title', 'Detalhes do Agendamento')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check"></i>
                    Detalhes do agendamento
                </h2>
                <p class="descricao-pagina">Resumo completo do atendimento selecionado.</p>
            </div>

            <a href="{{ route('agendamentos.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-clock"></i>
                        {{ $agendamento->data_hora_inicio->format('d/m/Y') }}
                    </h3>
                    <div class="painel-subtitulo">
                        {{ $agendamento->data_hora_inicio->format('H:i') }} ate {{ $agendamento->data_hora_fim->format('H:i') }}
                    </div>
                </div>
                <span class="status-agendamento {{ $agendamento->status }}">
                    {{ ucfirst($agendamento->status) }}
                </span>
            </div>

            <div class="p-4 p-md-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Cliente</div>
                        <div class="fw-bold">{{ $agendamento->cliente->nome }}</div>
                    </div>

                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Barbeiro</div>
                        <div class="fw-bold">{{ $agendamento->barbeiro->name }}</div>
                    </div>

                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Servico</div>
                        <span class="selo-servico">
                            <i class="fas fa-scissors"></i>
                            {{ $agendamento->servico->nome }}
                        </span>
                    </div>

                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Status</div>
                        <span class="status-agendamento {{ $agendamento->status }}">
                            {{ ucfirst($agendamento->status) }}
                        </span>
                    </div>

                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Inicio</div>
                        <div class="texto-horario">{{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }}</div>
                    </div>

                    <div class="col-md-6">
                        <div class="texto-secundario small text-uppercase fw-bold mb-1">Fim</div>
                        <div class="texto-horario">{{ $agendamento->data_hora_fim->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
