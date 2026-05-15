@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-user-edit"></i>
                    Editar cliente
                </h2>
                <p class="descricao-pagina">Atualize os dados cadastrais e de contato.</p>
            </div>

            <a href="{{ route('clientes.index') }}" class="btn botao-secundario">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="painel formulario-centralizado">
            <div class="painel-cabecalho">
                <div>
                    <h3 class="painel-titulo">
                        <i class="fas fa-address-card"></i>
                        {{ $cliente->nome }}
                    </h3>
                    <div class="painel-subtitulo">Cliente cadastrado no sistema.</div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <form method="POST" action="{{ route('clientes.update', $cliente) }}" class="formulario" data-formulario-carregando>
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" required class="form-control @error('nome') is-invalid @enderror">
                            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input id="telefone" type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" required class="form-control @error('telefone') is-invalid @enderror">
                            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input id="cpf" type="text" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" required class="form-control @error('cpf') is-invalid @enderror">
                            @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $cliente->email) }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="endereco" class="form-label">Endereco</label>
                            <input id="endereco" type="text" name="endereco" value="{{ old('endereco', $cliente->endereco) }}" class="form-control @error('endereco') is-invalid @enderror">
                            @error('endereco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-5">
                        <a href="{{ route('clientes.index') }}" class="btn botao-secundario">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn botao-primario">
                            <i class="fas fa-save"></i>
                            Salvar cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
