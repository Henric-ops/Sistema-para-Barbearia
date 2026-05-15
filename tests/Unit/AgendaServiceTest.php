<?php

namespace Tests\Unit;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\User;
use App\Services\AgendaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendaServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_identifica_conflito_real_de_horario(): void
    {
        [$barbeiro] = $this->criarBaseAgenda('agendado');

        $temConflito = app(AgendaService::class)->barbeiroTemConflito(
            $barbeiro->id,
            '2026-05-15 10:15',
            '2026-05-15 10:45'
        );

        $this->assertTrue($temConflito);
    }

    public function test_permite_horario_encostado_sem_sobreposicao(): void
    {
        [$barbeiro] = $this->criarBaseAgenda('agendado');

        $temConflito = app(AgendaService::class)->barbeiroTemConflito(
            $barbeiro->id,
            '2026-05-15 10:30',
            '2026-05-15 11:00'
        );

        $this->assertFalse($temConflito);
    }

    public function test_agendamento_cancelado_nao_bloqueia_horario(): void
    {
        [$barbeiro] = $this->criarBaseAgenda('cancelado');

        $temConflito = app(AgendaService::class)->barbeiroTemConflito(
            $barbeiro->id,
            '2026-05-15 10:15',
            '2026-05-15 10:45'
        );

        $this->assertFalse($temConflito);
    }

    private function criarBaseAgenda(string $status): array
    {
        $barbeiro = User::factory()->create(['cargo' => 'barbeiro']);

        $cliente = Cliente::create([
            'nome' => 'Cliente Teste',
            'cpf' => fake()->unique()->numerify('###########'),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => '11999999999',
        ]);

        $servico = Servico::create([
            'nome' => 'Corte',
            'descricao' => 'Corte simples',
            'preco' => 50,
            'duracao_minutos' => 30,
        ]);

        $agendamento = Agendamento::create([
            'cliente_id' => $cliente->id,
            'barbeiro_id' => $barbeiro->id,
            'servico_id' => $servico->id,
            'data_hora_inicio' => '2026-05-15 10:00',
            'data_hora_fim' => '2026-05-15 10:30',
            'status' => $status,
        ]);

        return [$barbeiro, $cliente, $servico, $agendamento];
    }
}
