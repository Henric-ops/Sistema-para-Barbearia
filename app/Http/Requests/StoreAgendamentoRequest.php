<?php

namespace App\Http\Requests;

use App\Models\Agendamento;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAgendamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->isAdministrador() ?? false;
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
            'cliente_id' => 'required|exists:clientes,id',
            'barbeiro_id' => 'required|exists:users,id',
            'servico_id' => 'required|exists:servicos,id',
            'data_hora_inicio' => 'required|date_format:Y-m-d H:i',
            'data_hora_fim' => 'required|date_format:Y-m-d H:i|after:data_hora_inicio',
            'status' => 'nullable|in:agendado,concluido,cancelado',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled(['barbeiro_id', 'data_hora_inicio', 'data_hora_fim'])) {
                $conflict = Agendamento::where('barbeiro_id', $this->barbeiro_id)
                    ->where(function ($query) {
                        $query->whereBetween('data_hora_inicio', [$this->data_hora_inicio, $this->data_hora_fim])
                            ->orWhereBetween('data_hora_fim', [$this->data_hora_inicio, $this->data_hora_fim])
                            ->orWhere(function ($query) {
                                $query->where('data_hora_inicio', '<', $this->data_hora_inicio)
                                    ->where('data_hora_fim', '>', $this->data_hora_fim);
                            });
                    })
                    ->exists();

                if ($conflict) {
                    $validator->errors()->add('data_hora_inicio', 'O barbeiro já possui agendamento nesse horário.');
                }
            }
        });
    }
}
