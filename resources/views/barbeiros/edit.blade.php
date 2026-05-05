@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/form.css') }}">

<div class="container-fluid py-4">

    <div class="form-container">

        <!-- HEADER -->
        <div class="form-header">
            <div>
                <h2 class="form-title">
                    <i class="fas fa-user-edit"></i>
                    Editar Barbeiro
                </h2>
                <p class="form-subtitle">
                    Atualize os dados do barbeiro
                </p>
            </div>

            <a href="{{ route('barbeiros.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <!-- FORM -->
        <div class="form-body">
            <form method="POST" action="{{ route('barbeiros.update', $barbeiro) }}">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    <!-- NOME -->
                    <div class="form-group">
                        <label class="form-label">Nome</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $barbeiro->name) }}"
                               required
                               class="form-control">

                        @error('name')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $barbeiro->email) }}"
                               required
                               class="form-control">

                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TELEFONE -->
                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input type="text"
                               name="telefone"
                               value="{{ old('telefone', $barbeiro->telefone) }}"
                               class="form-control">

                        @error('telefone')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- INFO -->
                <div class="form-alert">
                    <i class="fas fa-info-circle"></i>
                    Para alterar a senha, procure o administrador.
                </div>

                <!-- AÇÕES -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-gold">
                        <i class="fas fa-save"></i> Atualizar
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