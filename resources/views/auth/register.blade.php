<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --ouro: #c9a84c;
            --ouro-claro: #e8c97a;
            --ouro-suave: rgba(201, 168, 76, .14);
            --fundo: #070707;
            --superficie: #101010;
            --painel: #131313;
            --borda: rgba(255, 255, 255, .08);
            --texto: #f1f1ef;
            --suave: #b4b1aa;
            --fraco: #5a5650;
            --vermelho: #e05c5c;
            --verde: #6ec98a;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: var(--fundo);
            color: var(--texto);
            font-family: "DM Sans", sans-serif;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        /* Fundo decorativo */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% -10%, rgba(201, 168, 76, .18) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 85% 110%, rgba(201, 168, 76, .10) 0%, transparent 55%),
                radial-gradient(ellipse 30% 30% at 50% 50%, rgba(201, 168, 76, .04) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201, 168, 76, .025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201, 168, 76, .025) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* Wrapper */
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 560px;
            animation: fadeUp .65s ease-out both;
        }

        /* Marca */
        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-bottom: 36px;
            animation: fadeUp .6s ease-out .05s both;
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: rgba(201, 168, 76, .1);
            border: 1px solid rgba(201, 168, 76, .3);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 0 32px rgba(201, 168, 76, .15), inset 0 1px 0 rgba(255, 255, 255, .06);
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .brand-icon:hover {
            transform: scale(1.06);
            box-shadow: 0 0 48px rgba(201, 168, 76, .25), inset 0 1px 0 rgba(255, 255, 255, .08);
        }

        .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-name {
            font-family: "Playfair Display", serif;
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -.01em;
            color: var(--texto);
            line-height: 1;
        }

        .brand-sub {
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--ouro);
            margin-top: 2px;
        }

        /* Card */
        .card-login {
            background:
                radial-gradient(ellipse 80% 40% at 50% 0%, rgba(201, 168, 76, .07) 0%, transparent 60%),
                linear-gradient(160deg, rgba(255, 255, 255, .028) 0%, rgba(255, 255, 255, .008) 100%),
                var(--painel);
            border: 1px solid var(--borda);
            border-radius: 22px;
            padding: 40px;
            box-shadow:
                0 30px 80px rgba(0, 0, 0, .55),
                0 1px 0 rgba(255, 255, 255, .06) inset;
            animation: fadeUp .65s ease-out .1s both;
            transition: border-color .3s ease, box-shadow .3s ease;
        }

        .card-login:hover {
            border-color: rgba(201, 168, 76, .2);
            box-shadow:
                0 30px 80px rgba(0, 0, 0, .55),
                0 0 60px rgba(201, 168, 76, .06),
                0 1px 0 rgba(255, 255, 255, .06) inset;
        }

        .card-header-text {
            text-align: center;
            margin-bottom: 32px;
            animation: fadeUp .6s ease-out .15s both;
        }

        .card-header-text h2 {
            font-family: "Playfair Display", serif;
            font-size: 1.65rem;
            font-weight: 700;
            color: var(--texto);
            margin-bottom: 6px;
        }

        .card-header-text p {
            font-size: .9rem;
            color: var(--suave);
            font-weight: 500;
        }

        /* Divisor */
        .divider-ouro {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .divider-ouro::before,
        .divider-ouro::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 168, 76, .35), transparent);
        }

        .divider-ouro span {
            font-size: .7rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--ouro);
            font-weight: 700;
            white-space: nowrap;
        }

        /* Formulário */
        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: .73rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--suave);
            margin-bottom: 8px;
        }

        .form-group label i {
            color: var(--ouro);
            font-size: .8rem;
        }

        .form-control {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            border: 1px solid var(--borda);
            background: var(--superficie);
            color: var(--texto);
            font-family: "DM Sans", sans-serif;
            font-weight: 600;
            font-size: .95rem;
            padding: 0 16px;
            transition: border-color .25s ease, box-shadow .25s ease, background .25s ease;
            outline: none;
        }

        textarea.form-control {
            height: auto;
            padding: 12px 16px;
            resize: none;
        }

        .form-control::placeholder {
            color: var(--fraco);
            font-weight: 400;
        }

        .form-control:hover {
            border-color: rgba(201, 168, 76, .3);
        }

        .form-control:focus {
            border-color: rgba(201, 168, 76, .6);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, .1), inset 0 0 16px rgba(201, 168, 76, .04);
            background: #0d0d0d;
        }

        .form-control.is-invalid {
            border-color: var(--vermelho);
        }

        .invalid-feedback {
            color: #ffaaa5;
            font-size: .78rem;
            margin-top: 6px;
            display: block;
        }

        /* Seções de grupo */
        .fields-grid {
            display: grid;
            gap: 18px;
        }

        .fields-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        /* Separador de seção interno */
        .section-label {
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--fraco);
            padding-bottom: 10px;
            border-bottom: 1px solid var(--borda);
            margin-bottom: 4px;
        }

        /* Alerta */
        .auth-alerta {
            background: rgba(224, 92, 92, .08);
            border: 1px solid rgba(224, 92, 92, .25);
            border-radius: 12px;
            padding: 12px 16px;
            color: #ffaaa5;
            font-size: .85rem;
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            animation: slideDown .35s ease-out both;
        }

        .auth-alerta i {
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Botão */
        .btn-entrar {
            width: 100%;
            height: 52px;
            border-radius: 14px;
            border: 1px solid rgba(201, 168, 76, .5);
            background: linear-gradient(135deg, rgba(201, 168, 76, .28) 0%, rgba(201, 168, 76, .14) 100%);
            color: var(--texto);
            font-family: "DM Sans", sans-serif;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: .02em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            margin-top: 28px;
            position: relative;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease;
        }

        .btn-entrar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, .08) 50%, transparent 100%);
            transform: translateX(-100%);
            transition: transform .6s ease;
        }

        .btn-entrar:hover {
            background: linear-gradient(135deg, rgba(201, 168, 76, .4) 0%, rgba(201, 168, 76, .22) 100%);
            border-color: rgba(201, 168, 76, .75);
            box-shadow: 0 8px 28px rgba(201, 168, 76, .22), 0 0 0 1px rgba(201, 168, 76, .15);
            transform: translateY(-2px);
        }

        .btn-entrar:hover::before {
            transform: translateX(100%);
        }

        .btn-entrar:active {
            transform: translateY(0);
        }

        /* Rodapé do card */
        .card-footer-text {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--borda);
            text-align: center;
            font-size: .88rem;
            color: var(--suave);
            font-weight: 500;
        }

        .auth-link {
            color: var(--ouro);
            font-weight: 700;
            text-decoration: none;
            position: relative;
            transition: color .2s ease;
        }

        .auth-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--ouro-claro);
            transition: width .3s ease;
        }

        .auth-link:hover {
            color: var(--ouro-claro);
        }

        .auth-link:hover::after {
            width: 100%;
        }

        /* Tagline */
        .tagline {
            text-align: center;
            margin-top: 20px;
            font-size: .75rem;
            color: var(--fraco);
            letter-spacing: .04em;
            font-weight: 500;
            animation: fadeUp .6s ease-out .3s both;
        }

        /* Animações */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 520px) {
            .card-login {
                padding: 28px 20px;
            }

            .fields-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
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

        <!-- Card -->
        <div class="card-login">

            <div class="card-header-text">
                <h2>Criar conta</h2>
                <p>Preencha seus dados para criar o acesso.</p>
            </div>

            <div class="divider-ouro">
                <span>Cadastro de cliente</span>
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

            <form method="POST" action="{{ route('register') }}" data-formulario-carregando>
                @csrf

                <div class="fields-grid">

                    <!-- Dados pessoais -->
                    <div class="section-label">Dados pessoais</div>

                    <div class="form-group">
                        <label for="nome">
                            <i class="fas fa-user"></i>
                            Nome completo
                        </label>
                        <input id="nome" name="nome" value="{{ old('nome') }}"
                            class="form-control @error('nome') is-invalid @enderror" placeholder="Seu nome" required
                            autofocus>
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="fields-row">
                        <div class="form-group">
                            <label for="cpf">
                                <i class="fas fa-id-card"></i>
                                CPF
                            </label>
                            <input id="cpf" name="cpf" value="{{ old('cpf') }}"
                                class="form-control @error('cpf') is-invalid @enderror" placeholder="000.000.000-00"
                                required>
                            @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="telefone">
                                <i class="fas fa-phone"></i>
                                Telefone
                            </label>
                            <input id="telefone" name="telefone" value="{{ old('telefone') }}"
                                class="form-control @error('telefone') is-invalid @enderror"
                                placeholder="(11) 9 9999-9999" required>
                            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            E-mail
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="email@exemplo.com"
                            required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="endereco">
                            <i class="fas fa-map-marker-alt"></i>
                            Endereço
                        </label>
                        <textarea id="endereco" name="endereco" rows="2"
                            class="form-control @error('endereco') is-invalid @enderror"
                            placeholder="Rua, número, bairro...">{{ old('endereco') }}</textarea>
                        @error('endereco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Acesso -->
                    <div class="section-label" style="margin-top: 8px;">Acesso</div>

                    <div class="fields-row">
                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock"></i>
                                Senha
                            </label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Mínimo 8 caracteres" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                <i class="fas fa-lock-open"></i>
                                Confirmar senha
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" placeholder="Repita a senha" required>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn-entrar">
                    <i class="fas fa-user-plus"></i>
                    Criar conta
                </button>
            </form>

            <div class="card-footer-text">
                Já tem conta?
                <a href="{{ route('login') }}" class="auth-link">Entrar</a>
            </div>
        </div>

        <div class="tagline">Cadastro simples para clientes da barbearia.</div>

    </div>

    <script src="{{ asset('js/interface.js') }}"></script>

</body>

</html>