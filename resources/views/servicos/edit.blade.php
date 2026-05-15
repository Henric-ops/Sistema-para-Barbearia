@extends('layouts.app')

@section('title', 'Editar Servico')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-scissors"></i>
                    Editar servico
                </h2>
                <p class="descricao-pagina">Atualize informacoes do catalogo da barbearia.</p>
            </div>

            <a href="{{ route('servicos.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-list"></i>
                        {{ $servico->nome }}
                    </h3>
                    <div class="painel-subtitulo">R$ {{ number_format($servico->preco, 2, ',', '.') }} · {{ $servico->duracao_minutos }} min</div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <form method="POST" action="{{ route('servicos.update', $servico) }}" class="formulario" data-formulario-carregando>
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" name="nome" value="{{ old('nome', $servico->nome) }}" required class="form-control @error('nome') is-invalid @enderror">
                            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="descricao" class="form-label">Descricao</label>
                            <textarea id="descricao" name="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $servico->descricao) }}</textarea>
                            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="preco" class="form-label">Preco</label>
                            <input id="preco" type="number" step="0.01" name="preco" value="{{ old('preco', $servico->preco) }}" required class="form-control @error('preco') is-invalid @enderror">
                            @error('preco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="duracao_minutos" class="form-label">Duracao em minutos</label>
                            <input id="duracao_minutos" type="number" name="duracao_minutos" value="{{ old('duracao_minutos', $servico->duracao_minutos) }}" required class="form-control @error('duracao_minutos') is-invalid @enderror">
                            @error('duracao_minutos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-5">
                        <a href="{{ route('servicos.index') }}" class="btn botao-secundario">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn botao-primario">
                            <i class="fas fa-save"></i>
                            Salvar alteracoes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
