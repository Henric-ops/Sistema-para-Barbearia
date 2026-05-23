<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/autenticacao.css') }}" rel="stylesheet">
</head>
<body>
    <div class="auth-shell">
        <aside class="auth-marca">
            <div class="auth-logo">
                <span class="auth-logo-icone">
                    <img src="{{ asset('img/logobarber.png') }}" alt="BarberHub">
                </span>
                <div>
                    <div>BarberHub</div>
                    <div class="auth-logo-sub">barberclub</div>
                </div>
            </div>

            <div class="auth-menu-falso" aria-hidden="true">
                <div class="auth-menu-item ativo">
                    <i class="fas fa-user-plus"></i>
                    Cadastro
                </div>
                <div class="auth-menu-item">
                    <i class="fas fa-calendar-check"></i>
                    Agendamentos
                </div>
                <div class="auth-menu-item">
                    <i class="fas fa-scissors"></i>
                    Servicos
                </div>
            </div>

            <div class="auth-chamada">
                <h1>Seu horario, seu historico, tudo <span>organizado.</span></h1>
                <p>Crie sua conta para acompanhar atendimentos, status e informacoes cadastradas pela barbearia.</p>
            </div>

            <div class="auth-rodape">Cadastro simples para clientes da barbearia.</div>
        </aside>

        <main class="auth-conteudo">
            <section class="auth-card">
                <h2>Cadastro de cliente</h2>
                <p>Preencha seus dados para criar o acesso.</p>

                @if ($errors->any())
                    <div class="alert auth-alerta mt-4 mb-0">
                        <i class="fas fa-circle-exclamation me-2"></i>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="auth-form" data-formulario-carregando>
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 form-group">
                            <label for="nome" class="form-label">
                                <i class="fas fa-user"></i>
                                Nome
                            </label>
                            <input id="nome" name="nome" value="{{ old('nome') }}" class="form-control @error('nome') is-invalid @enderror" required autofocus>
                            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="cpf" class="form-label">
                                <i class="fas fa-id-card"></i>
                                CPF
                            </label>
                            <input id="cpf" name="cpf" value="{{ old('cpf') }}" class="form-control @error('cpf') is-invalid @enderror" placeholder="000.000.000-00" required>
                            @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="telefone" class="form-label">
                                <i class="fas fa-phone"></i>
                                Telefone
                            </label>
                            <input id="telefone" name="telefone" value="{{ old('telefone') }}" class="form-control @error('telefone') is-invalid @enderror" placeholder="(11) 9999-9999" required>
                            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                E-mail
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="email@exemplo.com" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="endereco" class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Endereço
                            </label>
                            <textarea id="endereco" name="endereco" rows="2" class="form-control @error('endereco') is-invalid @enderror" placeholder="Rua, número, bairro...">{{ old('endereco') }}</textarea>
                            @error('endereco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Senha
                            </label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock-open"></i>
                                Confirmar senha
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Repita a senha" required>
                        </div>
                    </div>

                    <button type="submit" class="auth-botao mt-4">
                        <i class="fas fa-user-plus"></i>
                        Criar conta
                    </button>
                </form>

                <div class="auth-divisor">
                    Ja tem conta?
                    <a href="{{ route('login') }}" class="auth-link">Entrar</a>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/interface.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
