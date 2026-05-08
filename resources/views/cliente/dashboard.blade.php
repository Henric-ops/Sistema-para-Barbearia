@extends('layouts.app')

@section('title', 'Meus Agendamentos')

@section('content')
    <div class="panel">
        <div class="panel-header">
            <div>
                <div class="panel-title"><i class="fas fa-calendar-alt"></i> Minha agenda</div>
                <div class="panel-sub">{{ $cliente->nome }}</div>
            </div>
        </div>

        <div style="overflow-x:auto">
            <table class="table table-sm" style="margin-bottom:0">
                <thead style="background: var(--bg-card)">
                    <tr>
                        <th style="padding:12px 16px;">Data</th>
                        <th style="padding:12px 16px;">Horario</th>
                        <th style="padding:12px 16px;">Barbeiro</th>
                        <th style="padding:12px 16px;">Servico</th>
                        <th style="padding:12px 16px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendamentos as $agendamento)
                        <tr>
                            <td style="padding:12px 16px;">
                                {{ $agendamento->data_hora_inicio->format('d/m/Y') }}
                            </td>
                            <td style="padding:12px 16px;">
                                <span class="datatime">
                                    {{ $agendamento->data_hora_inicio->format('H:i') }}
                                    - {{ $agendamento->data_hora_fim->format('H:i') }}
                                </span>
                            </td>
                            <td style="padding:12px 16px;">{{ $agendamento->barbeiro->name }}</td>
                            <td style="padding:12px 16px;">
                                <span class="badge servico-badge">{{ $agendamento->servico->nome }}</span>
                            </td>
                            <td style="padding:12px 16px;">
                                <span class="status-chip status-chip--{{ $agendamento->status }}">
                                    {{ ucfirst($agendamento->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:32px;text-align:center;color:var(--text-muted);">
                                <i class="fas fa-calendar-times" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                                Nenhum agendamento encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
