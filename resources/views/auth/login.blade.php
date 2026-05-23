<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Login</title>
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
                    <i class="fas fa-gauge-high"></i>
                    Dashboard
                </div>
                <div class="auth-menu-item">
                    <i class="fas fa-calendar-check"></i>
                    Agendamentos
                </div>
                <div class="auth-menu-item">
                    <i class="fas fa-users"></i>
                    Clientes
                </div>
            </div>

            <div class="auth-chamada">
                <h1>Gestao afiada para sua <span>barbearia.</span></h1>
                <p>Acesse o painel para acompanhar agenda, clientes, servicos e atendimento em uma experiencia unica.</p>
            </div>

            <div class="auth-rodape">Agenda, atendimento e controle em um so lugar.</div>
        </aside>

        <main class="auth-conteudo">
            <section class="auth-card">
                <h2>Bem-vindo</h2>
                <p>Acesse sua conta para continuar.</p>

                @if ($errors->any())
                    <div class="alert auth-alerta mt-4 mb-0">
                        <i class="fas fa-circle-exclamation me-2"></i>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="auth-form" data-formulario-carregando>
                    @csrf

                    <div class="mb-3 form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>
                            E-mail
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="email@exemplo.com" required autocomplete="email" autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4 form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i>
                            Senha
                        </label>
                        <div class="input-group">
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Digite sua senha" required autocomplete="current-password">
                            <button class="btn btn-outline-secondary" type="button" id="alternarSenha" aria-label="Mostrar senha">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="auth-botao">
                        <i class="fas fa-arrow-right"></i>
                        Entrar
                    </button>
                </form>

                <div class="auth-divisor">
                    Ainda nao tem conta?
                    <a href="{{ route('register') }}" class="auth-link">Cadastre-se como cliente</a>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/interface.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
    <script>
        document.getElementById('alternarSenha')?.addEventListener('click', function () {
            const campo = document.getElementById('password');
            const icone = this.querySelector('i');
            const mostrar = campo.type === 'password';
            campo.type = mostrar ? 'text' : 'password';
            icone.className = mostrar ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    </script>
</body>
</html>
