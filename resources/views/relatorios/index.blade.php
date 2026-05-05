@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title d-flex align-items-center gap-2">
                <span class="icon-box">
                    <i class="fas fa-chart-bar"></i>
                </span>
                Relatórios
            </h2>
            <p class="page-description">
                Visualize e exporte relatórios do sistema
            </p>
        </div>
    </div>

    <div class="row g-4">

        <!-- AGENDAMENTOS -->
        <div class="col-md-6">
            <div class="report-card">

                <div class="report-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <h5 class="report-title">Agendamentos</h5>
                <p class="report-desc">
                    Veja todos os agendamentos realizados no sistema
                </p>

                <div class="report-actions">
                    <a href="{{ route('relatorio.agendamentos') }}"
                       class="btn btn-outline-gold">
                        <i class="fas fa-eye"></i> Visualizar
                    </a>
                </div>

            </div>
        </div>

        <!-- SERVIÇOS -->
        <div class="col-md-6">
            <div class="report-card">

                <div class="report-icon">
                    <i class="fas fa-scissors"></i>
                </div>

                <h5 class="report-title">Serviços</h5>
                <p class="report-desc">
                    Analise os serviços mais realizados
                </p>

                <div class="report-actions">
                    <a href="{{ route('relatorio.servicos') }}"
                       class="btn btn-outline-gold">
                        <i class="fas fa-eye"></i> Visualizar
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection