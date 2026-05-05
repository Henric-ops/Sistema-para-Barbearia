@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/form.css') }}">

<div class="container-fluid py-4">

    <div class="form-container">

        <!-- HEADER -->
        <div class="form-header">
            <div>
                <h2 class="form-title">
                    <i class="fas fa-user-tie"></i>
                    Novo Barbeiro
                </h2>
                <p class="form-subtitle">
                    Cadastre um novo barbeiro
                </p>
            </div>

            <a href="{{ route('barbeiros.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <!-- FORM -->
        <div class="form-body">
            <form method="POST" action="{{ route('barbeiros.store') }}">
                @csrf

                <div class="form-grid">

                    <!-- NOME -->
                    <div class="form-group">
                        <label class="form-label">Nome</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               class="form-control"
                               placeholder="Nome completo">

                        @error('name')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               class="form-control"
                               placeholder="email@exemplo.com">

                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TELEFONE -->
                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input type="text"
                               name="telefone"
                               value="{{ old('telefone') }}"
                               class="form-control"
                               placeholder="(11) 99999-9999">

                        @error('telefone')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SENHA -->
                    <div class="form-group">
                        <label class="form-label">Senha</label>
                        <input type="password"
                               name="password"
                               required
                               class="form-control"
                               placeholder="Mínimo 6 caracteres">

                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONFIRMAR SENHA -->
                    <div class="form-group">
                        <label class="form-label">Confirmar Senha</label>
                        <input type="password"
                               name="password_confirmation"
                               required
                               class="form-control"
                               placeholder="Repita a senha">

                        @error('password_confirmation')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- AÇÕES -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-gold">
                        <i class="fas fa-save"></i> Cadastrar
                    </button>

                    <a href="{{ route('barbeiros.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection