@extends('layouts.app')

@section('title', 'Editar Barbeiro')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-user-edit"></i>
                    Editar barbeiro
                </h2>
                <p class="descricao-pagina">Atualize nome, e-mail e telefone do profissional.</p>
            </div>

            <a href="{{ route('barbeiros.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-id-badge"></i>
                        {{ $barbeiro->name }}
                    </h3>
                    <div class="painel-subtitulo">{{ $barbeiro->email }}</div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <form method="POST" action="{{ route('barbeiros.update', $barbeiro) }}" class="formulario" data-formulario-carregando>
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label">Nome</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $barbeiro->name) }}" required class="form-control @error('name') is-invalid @enderror">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $barbeiro->email) }}" required class="form-control @error('email') is-invalid @enderror">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input id="telefone" type="text" name="telefone" value="{{ old('telefone', $barbeiro->telefone) }}" class="form-control @error('telefone') is-invalid @enderror">
                            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="alert alerta-sistema d-flex align-items-center gap-2 mb-0">
                                <i class="fas fa-circle-info"></i>
                                Para alterar a senha, procure o administrador responsavel pelo acesso.
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-5">
                        <a href="{{ route('barbeiros.index') }}" class="btn botao-secundario">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn botao-primario">
                            <i class="fas fa-save"></i>
                            Atualizar barbeiro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
