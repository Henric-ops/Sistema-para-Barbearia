<?php

namespace App\Http\Requests;

use App\Services\AgendaService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->user()?->isAdministrador()) {
            return true;
        }

        $agendamento = $this->route('agendamento');

        return auth()->user()?->isBarbeiro()
            && $agendamento
            && auth()->id() === $agendamento->barbeiro_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function prepareForValidation()
    {
        // Converter formato do datetime-local (YYYY-MM-DDTHH:mm) para Y-m-d H:i
        if ($this->filled('data_hora_inicio')) {
            $this->merge([
                'data_hora_inicio' => str_replace('T', ' ', $this->data_hora_inicio),
            ]);
        }
        if ($this->filled('data_hora_fim')) {
            $this->merge([
                'data_hora_fim' => str_replace('T', ' ', $this->data_hora_fim),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'nullable|exists:clientes,id',
            'barbeiro_id' => 'nullable|exists:users,id',
            'servico_id' => 'nullable|exists:servicos,id',
            'data_hora_inicio' => 'nullable|date_format:Y-m-d H:i',
            'data_hora_fim' => 'nullable|date_format:Y-m-d H:i|after_or_equal:data_hora_inicio',
            'status' => 'nullable|in:agendado,concluido,cancelado',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $agendamento = $this->route('agendamento');

            if (! $agendamento) {
                return;
            }

            $barbeiroId = $this->filled('barbeiro_id') ? $this->barbeiro_id : $agendamento->barbeiro_id;
            $dataHoraInicio = $this->filled('data_hora_inicio') ? $this->data_hora_inicio : $agendamento->data_hora_inicio->format('Y-m-d H:i');
            $dataHoraFim = $this->filled('data_hora_fim') ? $this->data_hora_fim : $agendamento->data_hora_fim->format('Y-m-d H:i');

            if ($barbeiroId && $dataHoraInicio && $dataHoraFim) {
                $conflict = app(AgendaService::class)->barbeiroTemConflito(
                    (int) $barbeiroId,
                    $dataHoraInicio,
                    $dataHoraFim,
                    $agendamento->id
                );

                if ($conflict) {
                    $validator->errors()->add('data_hora_inicio', 'O barbeiro ja possui agendamento nesse horario.');
                }
            }
        });
    }
}
