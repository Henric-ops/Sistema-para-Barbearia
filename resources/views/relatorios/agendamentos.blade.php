<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Relatorio de Agendamentos</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }
        .header h1 { font-size: 22px; margin-bottom: 5px; }
        .header p { font-size: 14px; color: #666; }
        .periodo {
            margin-bottom: 25px;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            color: #444;
        }
        .section { margin-bottom: 30px; }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #333;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .table-container {
            border: 1px solid #eee;
            border-radius: 4px;
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        th {
            background: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .3px;
        }
        .resumo-table th,
        .resumo-table td {
            padding: 15px 10px;
            text-align: center;
        }
        .resumo-table .number {
            font-size: 22px;
            font-weight: bold;
            color: #222;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-agendado { background: #fff7df; color: #8a6a12; }
        .status-concluido { background: #e8f5e9; color: #2e7d32; }
        .status-cancelado { background: #ffebee; color: #c62828; }
        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #888;
            font-style: italic;
            border: 1px dashed #eee;
        }
        .footer {
            text-align: center;
            padding-top: 25px;
            border-top: 1px solid #eee;
            font-size: 11px;
            color: #777;
        }
        @media print {
            body { margin: 0; padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BarberHub</h1>
        <p>Relatorio de Agendamentos</p>
    </div>

    <div class="periodo">
        Periodo:
        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dataInicio)->format('d/m/Y') }}
        ate
        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dataFim)->format('d/m/Y') }}
    </div>

    <div class="section">
        <div class="section-title">Resumo Geral</div>
        <div class="table-container">
            <table class="resumo-table">
                <thead>
                    <tr>
                        <th>Total</th>
                        <th>Agendados</th>
                        <th>Concluidos</th>
                        <th>Cancelados</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="number">{{ $total }}</td>
                        <td class="number">{{ $agendados }}</td>
                        <td class="number">{{ $concluidos }}</td>
                        <td class="number">{{ $cancelados }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Lista de Agendamentos</div>

        @if($agendamentos->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Data/Hora</th>
                            <th>Cliente</th>
                            <th>Barbeiro</th>
                            <th>Servico</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendamentos as $agendamento)
                            <tr>
                                <td>{{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }}</td>
                                <td>{{ $agendamento->cliente->nome ?? 'N/A' }}</td>
                                <td>{{ $agendamento->barbeiro->name ?? 'N/A' }}</td>
                                <td>{{ $agendamento->servico->nome ?? 'N/A' }}</td>
                                <td>R$ {{ number_format($agendamento->servico->preco ?? 0, 2, ',', '.') }}</td>
                                <td>
                                    <span class="status status-{{ $agendamento->status }}">
                                        {{ ucfirst($agendamento->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">Nenhum agendamento encontrado.</div>
        @endif
    </div>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i:s') }} | BarberHub
    </div>
</body>
</html>
