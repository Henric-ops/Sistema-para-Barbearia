<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Cadastro de Cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #0D0D0D;
            --ink-mid: #161616;
            --ink-light: #222222;
            --ink-border: rgba(255, 255, 255, 0.08);
            --gold: #C9A84C;
            --gold-light: #E8C96B;
            --text: #FFFFFF;
            --muted: #9B9488;
            --error: #E06B5F;
            --gradient-accent: linear-gradient(135deg, #C9A84C 0%, #E8C96B 100%);
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--ink);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        .register-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(320px, 42%) 1fr;
        }

        .register-side {
            background: var(--ink-mid);
            border-right: 1px solid var(--ink-border);
            padding: 56px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .register-side::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
            opacity: .45;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--gradient-accent);
            color: var(--ink);
            display: grid;
            place-items: center;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .side-copy {
            position: relative;
            z-index: 1;
            max-width: 430px;
        }

        .side-copy h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 4vw, 4rem);
            line-height: 1.05;
            font-weight: 900;
            margin-bottom: 18px;
        }

        .side-copy em { color: var(--gold); }

        .side-copy p {
            color: var(--muted);
            line-height: 1.75;
            margin: 0;
        }

        .register-main {
            padding: 48px 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        .register-card {
            width: min(100%, 720px);
        }

        .card-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 6px;
        }

        .card-heading p {
            color: var(--muted);
            margin: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .full { grid-column: 1 / -1; }

        label {
            display: block;
            color: var(--muted);
            font-size: .74rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .form-control {
            background: var(--ink-light);
            border: 1px solid var(--ink-border);
            border-radius: 10px;
            color: var(--text);
            min-height: 50px;
        }

        .form-control:focus {
            background: rgba(201, 168, 76, .04);
            border-color: rgba(201, 168, 76, .65);
            color: var(--text);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, .13);
        }

        .form-control::placeholder { color: #555; }

        textarea.form-control { min-height: 96px; resize: vertical; }

        .form-error {
            color: var(--error);
            font-size: .8rem;
            margin-top: 6px;
        }

        .btn-register {
            width: 100%;
            min-height: 52px;
            border: 0;
            border-radius: 10px;
            background: var(--gradient-accent);
            color: var(--ink);
            font-weight: 800;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-top: 22px;
        }

        .login-link {
            text-align: center;
            color: var(--muted);
            margin-top: 22px;
        }

        .login-link a {
            color: var(--gold);
            font-weight: 700;
            text-decoration: none;
        }

        @media (max-width: 960px) {
            .register-shell { grid-template-columns: 1fr; }
            .register-side { display: none; }
            .register-main { padding: 36px 22px; }
        }

        @media (max-width: 620px) {
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <div class="register-shell">
        <aside class="register-side">
            <div class="brand-mark">
                <div class="brand-icon"><i class="fas fa-scissors"></i></div>
                <span class="brand-name">BarberHub</span>
            </div>

            <div class="side-copy">
                <h1>Seu acesso aos <em>agendamentos.</em></h1>
                <p>Acompanhe seus horarios cadastrados pela barbearia e veja historico, barbeiro, servico e status em um unico painel.</p>
            </div>
        </aside>

        <main class="register-main">
            <div class="register-card">
                <div class="card-heading">
                    <h2>Cadastro de cliente</h2>
                    <p>Crie sua conta para acompanhar seus agendamentos.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-grid">
                        <div>
                            <label for="nome">Nome</label>
                            <input class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required autofocus>
                            @error('nome') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="cpf">CPF</label>
                            <input class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
                            @error('cpf') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="telefone">Telefone</label>
                            <input class="form-control @error('telefone') is-invalid @enderror" id="telefone" name="telefone" value="{{ old('telefone') }}" required>
                            @error('telefone') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="full">
                            <label for="endereco">Endereco</label>
                            <textarea class="form-control @error('endereco') is-invalid @enderror" id="endereco" name="endereco">{{ old('endereco') }}</textarea>
                            @error('endereco') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="password">Senha</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation">Confirmar senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus me-2"></i> Cadastrar
                    </button>
                </form>

                <div class="login-link">
                    Ja tem conta? <a href="{{ route('login') }}">Entrar</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
