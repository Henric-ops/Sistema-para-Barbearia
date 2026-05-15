@extends('layouts.app')

@section('title', 'Novo Barbeiro')

@section('content')
    <div class="conteudo-pagina">
        <div class="cabecalho-pagina">
            <div>
                <h2 class="titulo-pagina d-flex align-items-center gap-2">
                    <i class="fas fa-user-tie"></i>
                    Novo barbeiro
                </h2>
                <p class="descricao-pagina">Cadastre um profissional com acesso ao painel de barbeiro.</p>
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
                        Dados do barbeiro
                    </h3>
                    <div class="painel-subtitulo">Nome, contato e senha inicial de acesso.</div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <form method="POST" action="{{ route('barbeiros.store') }}" class="formulario" data-formulario-carregando>
                    @csrf

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label">Nome</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror" placeholder="Nome completo">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror" placeholder="email@exemplo.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input id="telefone" type="text" name="telefone" value="{{ old('telefone') }}" class="form-control @error('telefone') is-invalid @enderror" placeholder="(11) 99999-9999">
                            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Minimo 6 caracteres">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirmar senha</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Repita a senha">
                            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-5">
                        <a href="{{ route('barbeiros.index') }}" class="btn botao-secundario">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn botao-primario">
                            <i class="fas fa-save"></i>
                            Cadastrar barbeiro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
