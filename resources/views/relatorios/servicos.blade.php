<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Relatorio de Servicos</title>
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
        }
        .ranking {
            text-align: center;
            font-weight: bold;
            width: 80px;
        }
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
        <p>Relatorio de Ranking de Servicos</p>
    </div>

    <div class="section">
        <div class="section-title">Resumo Geral</div>
        <div class="table-container">
            <table class="resumo-table">
                <thead>
                    <tr>
                        <th>Servicos cadastrados</th>
                        <th>Agendamentos confirmados</th>
                        <th>Receita total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="number">{{ $totalServicos }}</td>
                        <td class="number">{{ $servicosMaisUtilizados }}</td>
                        <td class="number">R$ {{ number_format($receitaTotal, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Ranking de Servicos Mais Realizados</div>

        @if($servicos->count() > 0 && $servicos->where('agendamentos_count', '>', 0)->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th class="ranking">Posicao</th>
                            <th>Servico</th>
                            <th>Valor unitario</th>
                            <th class="ranking">Agendamentos</th>
                            <th>Receita gerada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servicos as $index => $servico)
                            @if($servico->agendamentos_count > 0)
                                <tr>
                                    <td class="ranking">{{ $index + 1 }}</td>
                                    <td>{{ $servico->nome }}</td>
                                    <td>R$ {{ number_format($servico->preco, 2, ',', '.') }}</td>
                                    <td class="ranking">{{ $servico->agendamentos_count }}</td>
                                    <td>R$ {{ number_format($servico->preco * $servico->agendamentos_count, 2, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">Nenhum servico com agendamentos confirmados.</div>
        @endif
    </div>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i:s') }} | BarberHub
    </div>
</body>
</html>
