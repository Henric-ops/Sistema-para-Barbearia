@extends('layouts.app')

@section('title', 'Relatorios')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-chart-bar"></i>
                    Relatorios
                </h2>
                <p class="descricao-pagina">Visualize indicadores e exporte informacoes da barbearia.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="painel h-100">
                    <div class="p-4 p-md-5 d-flex flex-column h-100">
                        <span class="icone-indicador mb-4">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <h3 class="painel-titulo mb-2">Agendamentos</h3>
                        <p class="texto-secundario mb-4">
                            Consulte atendimentos por periodo, clientes, barbeiros, servicos e status.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('relatorio.agendamentos') }}" class="btn botao-primario">
                                <i class="fas fa-eye"></i>
                                Visualizar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="painel h-100">
                    <div class="p-4 p-md-5 d-flex flex-column h-100">
                        <span class="icone-indicador azul mb-4">
                            <i class="fas fa-scissors"></i>
                        </span>
                        <h3 class="painel-titulo mb-2">Servicos</h3>
                        <p class="texto-secundario mb-4">
                            Analise desempenho, volume de atendimentos e receita por servico.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('relatorio.servicos') }}" class="btn botao-primario">
                                <i class="fas fa-eye"></i>
                                Visualizar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
