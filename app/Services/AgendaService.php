<?php

namespace App\Services;

use App\Models\Agendamento;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class AgendaService
{
    public function barbeiroTemConflito(
        int $barbeiroId,
        CarbonInterface|string $inicio,
        CarbonInterface|string $fim,
        ?int $agendamentoIgnoradoId = null
    ): bool {
        $inicio = $this->normalizarDataHora($inicio);
        $fim = $this->normalizarDataHora($fim);

        return Agendamento::query()
            ->where('barbeiro_id', $barbeiroId)
            ->where('status', '<>', 'cancelado')
            ->when($agendamentoIgnoradoId, fn ($query) => $query->whereKeyNot($agendamentoIgnoradoId))
            ->where('data_hora_inicio', '<', $fim)
            ->where('data_hora_fim', '>', $inicio)
            ->exists();
    }

    private function normalizarDataHora(CarbonInterface|string $dataHora): string
    {
        if ($dataHora instanceof CarbonInterface) {
            return $dataHora->toDateTimeString();
        }

        return Carbon::parse($dataHora)->toDateTimeString();
    }
}
