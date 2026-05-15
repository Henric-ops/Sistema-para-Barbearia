@extends('layouts.app')

@section('title', auth()->user()->isAdministrador() ? 'Editar Agendamento' : 'Atualizar Status')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-edit"></i>
                    @if(auth()->user()->isAdministrador())
                        Editar agendamento
                    @else
                        Atualizar status
                    @endif
                </h2>
                <p class="descricao-pagina">
                    @if(auth()->user()->isAdministrador())
                        Ajuste cliente, barbeiro, servico, horario e status.
                    @else
                        Atualize apenas o andamento do seu atendimento.
                    @endif
                </p>
            </div>

            <a href="{{ route('agendamentos.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-pen-to-square"></i>
                        Dados do agendamento
                    </h3>
                    <div class="painel-subtitulo">
                        {{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }} ate {{ $agendamento->data_hora_fim->format('H:i') }}
                    </div>
                </div>
                <span class="status-agendamento {{ $agendamento->status }}">
                    {{ ucfirst($agendamento->status) }}
                </span>
            </div>

            <div class="p-4 p-md-5">
                <form action="{{ route('agendamentos.update', $agendamento) }}" method="POST" class="formulario" data-formulario-carregando @if(auth()->user()->isAdministrador()) data-formulario-agenda @endif>
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        @if(auth()->user()->isAdministrador())
                            <div class="col-12">
                                <label for="cliente_id" class="form-label">Cliente</label>
                                <select id="cliente_id" name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $agendamento->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="barbeiro_id" class="form-label">Barbeiro</label>
                                <select id="barbeiro_id" name="barbeiro_id" class="form-select @error('barbeiro_id') is-invalid @enderror" required>
                                    @foreach($barbeiros as $barbeiro)
                                        <option value="{{ $barbeiro->id }}" {{ old('barbeiro_id', $agendamento->barbeiro_id) == $barbeiro->id ? 'selected' : '' }}>
                                            {{ $barbeiro->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barbeiro_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="servico_id" class="form-label">Servico</label>
                                <select id="servico_id" name="servico_id" class="form-select @error('servico_id') is-invalid @enderror" data-servico-agenda required>
                                    @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}" data-duracao="{{ $servico->duracao_minutos }}" {{ old('servico_id', $agendamento->servico_id) == $servico->id ? 'selected' : '' }}>
                                            {{ $servico->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('servico_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_hora_inicio" class="form-label">Inicio</label>
                                <input
                                    type="datetime-local"
                                    id="data_hora_inicio"
                                    name="data_hora_inicio"
                                    value="{{ old('data_hora_inicio', $agendamento->data_hora_inicio->format('Y-m-d\TH:i')) }}"
                                    class="form-control @error('data_hora_inicio') is-invalid @enderror"
                                    data-inicio-agenda
                                    required
                                >
                                @error('data_hora_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_hora_fim" class="form-label">Fim</label>
                                <input
                                    type="datetime-local"
                                    id="data_hora_fim"
                                    name="data_hora_fim"
                                    value="{{ old('data_hora_fim', $agendamento->data_hora_fim->format('Y-m-d\TH:i')) }}"
                                    class="form-control @error('data_hora_fim') is-invalid @enderror"
                                    data-fim-agenda
                                    required
                                >
                                @error('data_hora_fim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <div class="col-12">
                                <div class="alert alerta-sistema d-flex align-items-center gap-2 mb-0">
                                    <i class="fas fa-circle-info"></i>
                                    Voce pode atualizar apenas o status deste agendamento.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Cliente</label>
                                <input type="text" class="form-control" value="{{ $agendamento->cliente->nome }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Servico</label>
                                <input type="text" class="form-control" value="{{ $agendamento->servico->nome }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Inicio</label>
                                <input type="text" class="form-control" value="{{ $agendamento->data_hora_inicio->format('d/m/Y H:i') }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fim</label>
                                <input type="text" class="form-control" value="{{ $agendamento->data_hora_fim->format('d/m/Y H:i') }}" disabled>
                            </div>
                        @endif

                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="agendado" {{ old('status', $agendamento->status) === 'agendado' ? 'selected' : '' }}>Agendado</option>
                                <option value="concluido" {{ old('status', $agendamento->status) === 'concluido' ? 'selected' : '' }}>Concluido</option>
                                <option value="cancelado" {{ old('status', $agendamento->status) === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-5">
                        <a href="{{ route('agendamentos.index') }}" class="btn botao-secundario">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn botao-primario">
                            <i class="fas fa-save"></i>
                            @if(auth()->user()->isAdministrador())
                                Atualizar agendamento
                            @else
                                Salvar status
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
