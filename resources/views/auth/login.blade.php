<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/autenticacao.css') }}" rel="stylesheet">
</head>
<body>

<div class="login-wrapper">

    <!-- Marca -->
    <div class="brand">
        <div class="brand-icon">
            <img src="{{ asset('img/logobarber.png') }}" alt="BarberHub">
        </div>
        <div>
            <div class="brand-name">BarberHub</div>
        </div>
    </div>

    <!-- Card de login -->
    <div class="card-login">

        <div class="card-header-text">
            <h2>Bem-vindo de volta</h2>
            <p>Acesse sua conta para continuar.</p>
        </div>

        <div class="divider-ouro">
            <span>Login</span>
        </div>

        @if ($errors->any())
            <div class="auth-alerta">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" data-formulario-carregando>
            @csrf

            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i>
                    E-mail
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="email@exemplo.com"
                    required
                    autocomplete="email"
                    autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                    Senha
                </label>
                <div class="input-senha">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Digite sua senha"
                        required
                        autocomplete="current-password">
                    <button type="button" class="btn-toggle-senha" id="alternarSenha" aria-label="Mostrar senha">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-entrar">
                <i class="fas fa-arrow-right-to-bracket"></i>
                Entrar
            </button>
        </form>

        <div class="card-footer-text">
            Ainda não tem conta?
            <a href="{{ route('register') }}" class="auth-link">Cadastre-se como cliente</a>
        </div>
    </div>

    <div class="tagline">Agenda, atendimento e controle em um só lugar.</div>

</div>

<script src="{{ asset('js/interface.js') }}"></script>
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