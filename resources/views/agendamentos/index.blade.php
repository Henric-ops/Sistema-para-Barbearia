@extends('layouts.app')

@section('title', 'Minha agenda')

@section('content')
    @php
        $horaInicial = 8;
        $horaFinal = 18;
        $inicioAgendaMinutos = $horaInicial * 60;
        $totalMinutosAgenda = ($horaFinal - $horaInicial) * 60;
        $horasAgenda = range($horaInicial, $horaFinal);
    @endphp

    <div class="conteudo-pagina">
        @if(session('success'))
            <div class="alert alerta-sistema d-flex align-items-center gap-2 mb-0">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <section class="agenda-controles painel">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-alt"></i>
                    Minha agenda
                </h2>
                <p class="descricao-pagina">Timeline clara para acompanhar horarios, barbeiros e status.</p>
            </div>

            <form method="GET" class="agenda-filtros">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <div class="agenda-segmentos" aria-label="Modo de visualizacao">
                    <span class="ativo">Dia</span>
                </div>

                <div class="agenda-navegacao">
                    <a class="botao-icone" href="{{ route('agendamentos.index', array_filter([
                        'data' => $dataAnterior->toDateString(),
                        'barbeiro_id' => $barbeiroSelecionado,
                        'search' => request('search'),
                    ])) }}" aria-label="Dia anterior">
                        <i class="fas fa-chevron-left"></i>
                    </a>

                    <a class="btn botao-secundario" href="{{ route('agendamentos.index', array_filter([
                        'data' => now()->toDateString(),
                        'barbeiro_id' => $barbeiroSelecionado,
                        'search' => request('search'),
                    ])) }}">
                        Hoje
                    </a>

                    <a class="botao-icone" href="{{ route('agendamentos.index', array_filter([
                        'data' => $dataProxima->toDateString(),
                        'barbeiro_id' => $barbeiroSelecionado,
                        'search' => request('search'),
                    ])) }}" aria-label="Proximo dia">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                @if(! auth()->user()->isBarbeiro())
                    <select name="barbeiro_id" class="form-select agenda-select" data-auto-submit>
                        <option value="">Todos os barbeiros</option>
                        @foreach($barbeirosFiltro as $barbeiroOpcao)
                            <option value="{{ $barbeiroOpcao->id }}" {{ (string) $barbeiroSelecionado === (string) $barbeiroOpcao->id ? 'selected' : '' }}>
                                {{ $barbeiroOpcao->name }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <input type="date" name="data" value="{{ $dataSelecionada->toDateString() }}" class="form-control agenda-data" data-auto-submit>
            </form>
        </section>

        <div class="agenda-resumo">
            <span class="selo-contador">Periodo {{ $dataSelecionada->format('d/m/Y') }}</span>
            <span class="selo-contador">{{ $barbeiroSelecionado ? 'Barbeiro selecionado' : 'Todos os barbeiros' }}</span>
            <span class="selo-contador">{{ $agendamentos->count() }} agendamento(s)</span>
        </div>

        <section class="agenda-dia" data-agenda-dia>
            <div class="agenda-horarios">
                <div class="agenda-canto"></div>
                @foreach($horasAgenda as $hora)
                    <div class="agenda-hora" data-agenda-hora>{{ str_pad($hora, 2, '0', STR_PAD_LEFT) }}:00</div>
                @endforeach
            </div>

            <div class="agenda-colunas">
                @forelse($barbeiros as $barbeiro)
                    <div class="agenda-coluna">
                        <div class="agenda-barbeiro">{{ $barbeiro->name }}</div>
                        <div class="agenda-trilha" data-total-minutos="{{ $totalMinutosAgenda }}">
                            @for($hora = $horaInicial; $hora < $horaFinal; $hora++)
                                <div class="agenda-linha-hora"></div>
                            @endfor

                            @foreach($agendamentosPorBarbeiro->get($barbeiro->id, collect()) as $agendamento)
                                @php
                                    $inicioMinutos = ($agendamento->data_hora_inicio->hour * 60) + $agendamento->data_hora_inicio->minute - $inicioAgendaMinutos;
                                    $duracaoMinutos = max(30, $agendamento->data_hora_inicio->diffInMinutes($agendamento->data_hora_fim));
                                @endphp

                                <article
                                    class="agenda-card status-{{ $agendamento->status }}"
                                    data-inicio-min="{{ max(0, $inicioMinutos) }}"
                                    data-duracao-min="{{ $duracaoMinutos }}"
                                >
                                    <div class="agenda-card-topo">
                                        <strong>
                                            {{ $agendamento->data_hora_inicio->format('H:i') }}
                                            - {{ $agendamento->data_hora_fim->format('H:i') }}
                                        </strong>
                                        <span class="status-agendamento {{ $agendamento->status }}">
                                            {{ ucfirst($agendamento->status) }}
                                        </span>
                                    </div>

                                    <div class="agenda-card-corpo">
                                        <span>{{ $agendamento->cliente->nome }}</span>
                                        <span class="agenda-card-servico">{{ $agendamento->servico->nome }}</span>
                                    </div>

                                    <div class="agenda-card-acoes">
                                        <a href="{{ route('agendamentos.show', $agendamento) }}" data-bs-toggle="tooltip" data-bs-title="Ver detalhes" aria-label="Ver detalhes">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if(auth()->user()->isAdministrador() || auth()->id() === $agendamento->barbeiro_id)
                                            <a href="{{ route('agendamentos.edit', $agendamento) }}" data-bs-toggle="tooltip" data-bs-title="Editar" aria-label="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif

                                        @if(auth()->user()->isAdministrador())
                                            <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-confirmacao="Tem certeza que deseja excluir este agendamento?" data-bs-toggle="tooltip" data-bs-title="Excluir" aria-label="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="painel">
                        <div class="estado-vazio">
                            <i class="fas fa-user-tie"></i>
                            <p class="mb-0">Nenhum barbeiro para exibir nesta agenda.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
